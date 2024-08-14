<?php
// Luodaan yhteys tietokantaan ja haetaan tuotetiedot
require_once "inc/database.php";

// Alustetaan tuotteenn tunnistava muuttuja
$tuoteID = null;

// Tarkistetaan onko tuoteID annettu GET-metodilla
// Jos on niin tallennetaan arvo muuttujaan
if (!empty($_GET['tuoteID'])) {
  $tuoteID = $_REQUEST['tuoteID'];
}

// Jos tuoteID-parametriä ei välitetty, palautetaan käyttäjä takaisin tuote.php sivulle
if ($tuoteID == null) {
  header("Location: tuote.php");
  exit;
}


// Jos välitettiin, niin haetaan taulusta kyseisen tuotteen tiedot data muuttujaan
$sql = "SELECT * FROM tuote WHERE tuoteID = :tuoteID";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':tuoteID', $tuoteID, PDO::PARAM_INT);
$stmt->execute();

$tuote = $stmt->fetch(PDO::FETCH_OBJ);


// Luetaan tuotteen tiedot kannasta
$nimi = $tuote->nimi;
$kuvaus = $tuote->kuvaus;
$kpl = $tuote->kpl;
$painoraja = $tuote->painoraja;
$kuva = $tuote->kuva;

?>

<?php
require_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Tuotetietojen seuranta</h3>
        <form class="mt-3">
          <div class="mb-3 row">
            <label for="nimi" class="col-sm-3 col-form-label">Nimi</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $nimi; ?>" name="nimi" class="form-control" id="inputNimi">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kuvaus" class="col-sm-3 col-form-label">Kuvaus</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $kuvaus; ?>" name="kuvaus" class="form-control" id="inputKuvaus">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kpl" class="col-sm-3 col-form-label">Kappalemäärä</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $kpl; ?>" name="kpl" class="form-control" id="inputKpl">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="painoraja" class="col-sm-3 col-form-label">Painoraja</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $painoraja; ?>" name="painoraja" class="form-control" id="inputPainoraja">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kuva" class="col-sm-3 col-form-label">Kuva</label>
            <div class="col-sm-9">
              <img id="katsotuote" src="img/<?php echo $kuva; ?>" alt="tuotekuva" class="thumbnail" >
            </div>
          </div>
          <div class="col-12 text-center">
            <a href="tuote.php" class="btn btn-secondary">Takaisin</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>