<?php

//Haetaan tiedosto, jonka avulla saamme yhteyden tietokantaan
require_once "inc/database.php";

if (!empty($_POST)) {
  //Haetaan valitun tuotteen tiedot
  $tuoteID = $_POST['tuoteID'];

  //Poistetaan valitun tuotteen tiedot
  $sql = "DELETE FROM tuote WHERE tuoteID = :tuoteID";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':tuoteID', $_POST['tuoteID'], PDO::PARAM_INT);
  $stmt->execute();

  //Ohjataan käyttäjä takaisin tuotesivulle
  header("Location: tuote.php");
  exit;
} else {

  // Alustetaan tuotteen tunnistava muuttuja
  $tuoteID = null;

  //Tarkistetaan, että onko tuoteID parametri välitetty GET-metodilla
  // Jos on niin tallennetaan arvo muuttujaan
  if (!empty($_GET['tuoteID'])) {
    $tuoteID = $_REQUEST['tuoteID'];
  }

  // Jos tuoteID-parametriä ei välitetty, palautetaan käyttäjä takaisin tuote.php sivulle
  if ($tuoteID == null) {
    header("Location: tuote.php");
  }

  $sql = "SELECT tuoteID, CONCAT(nimi, ' ','ID:',tuoteID) AS nimi FROM tuote WHERE tuoteID = :tuoteID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':tuoteID', $tuoteID, PDO::PARAM_INT);
  $stmt->execute();

  $tuote = $stmt->fetch(PDO::FETCH_OBJ);

  if ($tuote === false) {
    header("Location: tuote.php");
  }
}
?>


<?php
include_once 'inc/header.php';
?>

<div class="container text-center">
  <div class="card card-body bg-light mt-3">
    <h3>Tuotetietojen poistaminen</h3>
    <p>Haluatko varmasti poistaa tuotteen, <?php echo $tuote->nimi; ?>, tiedot?</p>
    <form action="poista_tuote.php" method="post">
      <input type="hidden" name="tuoteID" value="<?php echo $tuote->tuoteID; ?>">
      <button type="submit" class="btn btn-danger">Poista</button>
      <a href="tuote.php" class="btn btn-secondary">Takaisin</a>
    </form>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>