<?php

require_once 'inc/database.php';

if (!empty($_POST)) {

  //luetaan lomakkeen lähettämät tiedot
  $nimi = $_POST['nimi'];
  $kuvaus = $_POST['kuvaus'];
  $kpl = $_POST['kpl'];
  $painoraja = $_POST['painoraja'];
  $kuva = $_POST['kuva'];
  $tuoteID = $_POST['tuoteID'];

  //Puuttuvien kenttien ohjeteksit
  $nimiError = '';
  $kuvausError = '';
  $kplError = '';
  $painorajaError = '';
  $kuvaError = '';

  //alustetaan tarkistus muuttuja
  // oletetaan, että tiedot on syötetty oikein
  $valid = true;

  if (empty($nimi)) {
    $nimiError = 'Syötä nimi';
    $valid = false;
  }

  if (empty($kuvaus)) {
    $kuvausError = 'Syötä kuvaus';
    $valid = false;
  }

  if (empty($kpl)) {
    $kplError = 'Syötä kpl';
    $valid = false;
  }

  if (empty($painoraja)) {
    $painorajaError = 'Syötä pai$painoraja';
    $valid = false;
  }

  if (empty($kuva)) {
    $kuvaError = 'Syötä kuva$kuva';
    $valid = false;
  }

  if ($valid) {
    //jos käyttäjä antanut kaikki tiedot
    // niin tallennetaan tiedot kantaan
    $sql = "UPDATE tuote SET nimi = :nimi, kuvaus = :kuvaus, kpl = :kpl, painoraja = :painoraja,
     kuva = :kuva WHERE tuoteID = :tuoteID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nimi', $nimi, PDO::PARAM_STR);
    $stmt->bindParam(':kuvaus', $kuvaus, PDO::PARAM_STR);
    $stmt->bindParam(':kpl', $kpl, PDO::PARAM_STR);
    $stmt->bindParam(':painoraja', $painoraja, PDO::PARAM_STR);
    $stmt->bindParam(':kuva', $kuva, PDO::PARAM_STR);
    $stmt->bindParam(':tuoteID', $tuoteID, PDO::PARAM_INT);
    $stmt->execute();

    //ohjaus tuotetietoihin takaisin
    header("Location: tuote.php");
    exit;
  }
} else {
  //alustetaan tuotteen tunnistava muuttuja
  $tuoteID = null;

  //tarkistetaan, että onko tuoteID parametri välitetty GET-metodilla
  // jos on niin tallennetaan arvo muuttujaan
  if (!empty($_GET['tuoteID'])) {
    $tuoteID = $_REQUEST['tuoteID'];
  }

  if ($tuoteID == null) {
    header("Location: tuote.php");
  }

  //jos välitettiin, niin haetaan taulusta kyseisen tuotteen teidot data muuttujaan
  $sql = "SELECT * FROM tuote WHERE tuoteID = :tuoteID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':tuoteID', $tuoteID, PDO::PARAM_INT);
  $stmt->execute();

  $tuote = $stmt->fetch(PDO::FETCH_OBJ);

  //Luetaan tuotteen teidot kannasta
  $nimi = $tuote->nimi;
  $kuvaus = $tuote->kuvaus;
  $kpl = $tuote->kpl;
  $painoraja = $tuote->painoraja;
  $kuva = $tuote->kuva;
}
?>

<?php
include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Tuotetietojen päivittäminen</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-3">
          <input type="hidden" name="tuoteID" value="<?php echo $tuoteID; ?>">
          <div class="mb-3 row">
            <label for="nimi" class="col-sm-3 col-form-label">Nimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $nimi; ?>" name="nimi" class="form-control <?php echo (!empty($nimiError)) ? 'is-invalid' : ''; ?>" id="inputNimi">
              <?php if (!empty($nimiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $nimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kuvaus" class="col-sm-3 col-form-label">Kuvaus</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $kuvaus; ?>" name="kuvaus" class="form-control <?php echo (!empty($kuvausError)) ? 'is-invalid' : ''; ?>" id="inputKuvaus">
              <?php if (!empty($kuvausError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $kuvausError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kpl" class="col-sm-3 col-form-label">Kpl</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $kpl; ?>" name="kpl" class="form-control <?php echo (!empty($kplError)) ? 'is-invalid' : ''; ?>" id="inputKpl">
              <?php if (!empty($kplError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $kplError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="painoraja" class="col-sm-3 col-form-label">Painoraja</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $painoraja; ?>" name="painoraja" class="form-control <?php echo (!empty($painorajaError)) ? 'is-invalid' : ''; ?>" id="inputPainoraja">
              <?php if (!empty($painorajaError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $painorajaError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="kuva" class="col-sm-3 col-form-label">Kuva</label>
            <div class="col-sm-9">
              <input type="file" value="<?php echo (!empty($_POST) && !empty($kuvaError)) ? 'is-invalid' : ''; ?>" id="kuva" name="kuva" aria-describedby="" required>
              <div class="invalid-feedback">
                <small><?php echo $kuvaError ?? ''; ?></small>
              </div>
            </div>
          </div>

          <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit">Tallenna</button>
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