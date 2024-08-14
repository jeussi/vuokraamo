<?php
// Luodaan yhteys tietokantaan ja haetaan myyjatiedot
require_once "inc/database.php";

// Alustetaan myyjan tunnistava muuttuja
$myyjaID = null;

// Tarkistetaan onko myyjaID annettu GET-metodilla
// Jos on niin tallennetaan arvo muuttujaan
if (!empty($_GET['myyjaID'])) {
  $myyjaID = $_REQUEST['myyjaID'];
}

// Jos myyjaID-parametriä ei välitetty, palautetaan käyttäjä takaisin myyja.php sivulle
if ($myyjaID == null) {
  header("Location: myyja.php");
  exit;
}


// Jos välitettiin, niin haetaan taulusta kyseisen tuotteen tiedot data muuttujaan
$sql = "SELECT * FROM myyja WHERE myyjaID = :myyjaID";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':myyjaID', $myyjaID, PDO::PARAM_INT);
$stmt->execute();

$myyja = $stmt->fetch(PDO::FETCH_OBJ);


// Luetaan tuotteen tiedot kannasta
$nimi = $myyja->nimi;
$rooli = $myyja->rooli;
$kayttajatunnus = $myyja->kayttajatunnus;
$salasana = $myyja->salasana;

?>

<?php
require_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Myyjätietojen seuranta</h3>
        <form class="mt-3">
          <div class="mb-3 row">
            <label for="nimi" class="col-sm-3 col-form-label">Nimi</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $nimi; ?>" name="nimi" class="form-control" id="inputNimi">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="rooli" class="col-sm-3 col-form-label">Rooli</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $rooli; ?>" name="rooli" class="form-control" id="inputRooli">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kayttajatunnus" class="col-sm-3 col-form-label">Käyttäjätunnus</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $kayttajatunnus; ?>" name="kayttajatunnus" class="form-control" id="inputKayttajatunnus">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="salasana" class="col-sm-3 col-form-label">Salasana</label>
            <div class="col-sm-9">
              <input type="text" readonly value="<?php echo $salasana; ?>" name="salasana" class="form-control" id="inputSalasana">
            </div>
          </div>

          <div class="col-12 text-center">
            <a href="myyja.php" class="btn btn-secondary">Takaisin</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>