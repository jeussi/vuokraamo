<?php

require_once 'inc/database.php';

if (!empty($_POST)) {

  //luetaan lomakkeen lähettämät tiedot
  $nimi = $_POST['nimi'];
  $kayttajatunnus = $_POST['kayttajatunnus'];
  $rooli = $_POST['rooli'];
  $salasana = $_POST['salasana'];
  $myyjaID = $_POST['myyjaID'];

  //Puuttuvien kenttien ohjeteksit
  $nimiError = '';
  $kayttajatunnusError = '';
  $rooliError = '';
  $salasanaError = '';

  //alustetaan tarkistus muuttuja
  // oletetaan, että tiedot on syötetty oikein
  $valid = true;

  if (empty($nimi)) {
    $nimiError = 'Syötä nimi';
    $valid = false;
  }

  if (empty($kayttajatunnus)) {
    $kayttajatunnusError = 'Syötä kayttajatunnus';
    $valid = false;
  }

  if (empty($rooli)) {
    $rooliError = 'Syötä rooli';
    $valid = false;
  }

  if (empty($salasana)) {
    $salasanaError = 'Syötä salasana';
    $valid = false;
  }


  if ($valid) {
    //jos käyttäjä antanut kaikki tiedot
    // niin tallennetaan tiedot kantaan
    $sql = "UPDATE myyja SET nimi = :nimi, kayttajatunnus = :kayttajatunnus, rooli = :rooli, salasana = :salasana
     WHERE myyjaID = :myyjaID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nimi', $nimi, PDO::PARAM_STR);
    $stmt->bindParam(':kayttajatunnus', $kayttajatunnus, PDO::PARAM_STR);
    $stmt->bindParam(':rooli', $rooli, PDO::PARAM_STR);
    $stmt->bindParam(':salasana', $salasana, PDO::PARAM_STR);
    $stmt->bindParam('myyjaID', $myyjaID, PDO::PARAM_INT);
    $stmt->execute();

    //ohjaus myyjätietoihin takaisin
    header("Location: myyja.php");
    exit;
  }
} else {
  //alustetaan myyjän tunnistava muuttuja
  $myyjaID = null;

  //tarkistetaan, että onko myyjaID parametri välitetty GET-metodilla
  // jos on niin tallennetaan arvo muuttujaan
  if (!empty($_GET['myyjaID'])) {
    $myyjaID = $_REQUEST['myyjaID'];
  }

  if ($myyjaID == null) {
    header("Location: myyja.php");
  }

  //jos välitettiin, niin haetaan taulusta kyseisen tuotteen teidot data muuttujaan
  $sql = "SELECT * FROM myyja WHERE myyjaID = :myyjaID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':myyjaID', $myyjaID, PDO::PARAM_INT);
  $stmt->execute();

  $myyja = $stmt->fetch(PDO::FETCH_OBJ);

  //Luetaan myyjän teidot kannasta
  $nimi = $myyja->nimi;
  $kayttajatunnus = $myyja->kayttajatunnus;
  $rooli = $myyja->rooli;
  $salasana = $myyja->salasana;
}
?>

<?php
include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Myyjätietojen päivittäminen</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-3">
          <input type="hidden" name="myyjaID" value="<?php echo $myyjaID; ?>">
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
            <label for="kayttajatunnus" class="col-sm-3 col-form-label">Kayttajatunnus</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $kayttajatunnus; ?>" name="kayttajatunnus" class="form-control <?php echo (!empty($kayttajatunnusError)) ? 'is-invalid' : ''; ?>" id="inputKayttajatunnus">
              <?php if (!empty($kayttajatunnusError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $kayttajatunnusError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="rooli" class="col-sm-3 col-form-label">Rooli</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $rooli; ?>" name="rooli" class="form-control <?php echo (!empty($rooliError)) ? 'is-invalid' : ''; ?>" id="inputRooli">
              <?php if (!empty($rooliError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $rooliError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="salasana" class="col-sm-3 col-form-label">Salasana</label>
            <div class="col-sm-9">
              <input type="password" value="<?php echo $salasana; ?>" name="salasana" class="form-control <?php echo (!empty($salasanaError)) ? 'is-invalid' : ''; ?>" id="inputSalasana">
              <?php if (!empty($salasanaError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $salasanaError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit">Tallenna</button>
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