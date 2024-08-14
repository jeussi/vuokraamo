<?php

require_once 'inc/database.php';

if (!empty($_POST)) {

  //luetaan lomakkeen lähettämät tiedot
  $etunimi = $_POST['etunimi'];
  $sukunimi = $_POST['sukunimi'];
  $sahkoposti = $_POST['sahkoposti'];
  $lahiosoite = $_POST['lahiosoite'];
  $postinumero = $_POST['postinumero'];
  $postitoimipaikka = $_POST['postitoimipaikka'];
  $puhelin = $_POST['puhelin'];
  $henkilotunnus = $_POST['henkilotunnus'];
  $asiakasID = $_POST['asiakasID'];

  //Puuttuvien kenttien ohjeteksit
  $etunimiError = '';
  $sukunimiError = '';
  $sahkopostiError = '';
  $lahiosoiteError = '';
  $postinumeroError = '';
  $postitoimipaikkaError = '';
  $puhelinError = '';
  $henkilotunnusError = '';

  //alustetaan tarkistus muuttuja
  // oletetaan, että tiedot on syötetty oikein
  $valid = true;

  if (empty($etunimi)) {
    $etunimiError = 'Syötä etunimi';
    $valid = false;
  }

  if (empty($sukunimi)) {
    $sukunimiError = 'Syötä sukunimi';
    $valid = false;
  }

  if (empty($sahkoposti)) {
    $sahkopostiError = 'Syötä sähköposti';
    $valid = false;
  }

  if (empty($lahiosoite)) {
    $lahiosoiteError = 'Syötä lähiosoite';
    $valid = false;
  }

  if (empty($postinumero)) {
    $postinumeroError = 'Syötä postinumero';
    $valid = false;
  }

  if (empty($postitoimipaikka)) {
    $postitoimipaikkaError = 'Syötä postitoimipaikka';
    $valid = false;
  }

  if (empty($puhelin)) {
    $puhelinError = 'Syötä puhelin';
    $valid = false;
  }

  if (empty($henkilotunnus)) {
    $henkilotunnusError = 'Syötä henkilötunnus';
    $valid = false;
  }

  if ($valid) {
    //jos käyttäjä antanut kaikki tiedot
    // niin tallennetaan tiedot kantaan
    $sql = "UPDATE asiakas SET etunimi = :etunimi, sukunimi = :sukunimi, sahkoposti = :sahkoposti, lahiosoite = :lahiosoite,
     postinumero = :postinumero, postitoimipaikka = :postitoimipaikka, puhelin = :puhelin, henkilotunnus = :henkilotunnus WHERE asiakasID = :asiakasID";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':etunimi', $etunimi, PDO::PARAM_STR);
    $stmt->bindParam(':sukunimi', $sukunimi, PDO::PARAM_STR);
    $stmt->bindParam(':sahkoposti', $sahkoposti, PDO::PARAM_STR);
    $stmt->bindParam(':lahiosoite', $lahiosoite, PDO::PARAM_STR);
    $stmt->bindParam(':postinumero', $postinumero, PDO::PARAM_STR);
    $stmt->bindParam(':postitoimipaikka', $postitoimipaikka, PDO::PARAM_STR);
    $stmt->bindParam(':puhelin', $puhelin, PDO::PARAM_STR);
    $stmt->bindParam(':henkilotunnus', $henkilotunnus, PDO::PARAM_STR);
    $stmt->bindParam(':asiakasID', $asiakasID, PDO::PARAM_INT);
    $stmt->execute();

    //ohjaus asiakastietoihin takaisin
    header("Location: asiakas.php");
    exit;
  }
} else {
  //alustetaan asiakkaan tunnistava muuttuja
  $asiakasID = null;

  //tarkistetaan, että onko asiakasID parametri välitetty GET-metodilla
  // jos on niin tallennetaan arvo muuttujaan
  if (!empty($_GET['asiakasID'])) {
    $asiakasID = $_REQUEST['asiakasID'];
  }

  if ($asiakasID == null) {
    header("Location: asiakas.php");
  }

  //jos välitettiin, niin haetaan taulusta kyseisen asiakkaan teidot data muuttujaan
  $sql = "SELECT * FROM asiakas WHERE asiakasID = :asiakasID";

  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':asiakasID', $asiakasID, PDO::PARAM_INT);
  $stmt->execute();

  $asiakas = $stmt->fetch(PDO::FETCH_OBJ);

  //Luetaan asiakkaan teidot kannasta
  $etunimi = $asiakas->etunimi;
  $sukunimi = $asiakas->sukunimi;
  $sahkoposti = $asiakas->sahkoposti;
  $lahiosoite = $asiakas->lahiosoite;
  $postinumero = $asiakas->postinumero;
  $postitoimipaikka = $asiakas->postitoimipaikka;
  $puhelin = $asiakas->puhelin;
  $henkilotunnus = $asiakas->henkilotunnus;
}
?>

<?php
include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Asiakastietojen päivittäminen</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-3">
          <input type="hidden" name="asiakasID" value="<?php echo $asiakasID; ?>">
          <div class="mb-3 row">
            <label for="etunimi" class="col-sm-3 col-form-label">Etunimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $etunimi; ?>" name="etunimi" class="form-control <?php echo (!empty($etunimiError)) ? 'is-invalid' : ''; ?>" id="inputEtunimi">
              <?php if (!empty($etunimiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $etunimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="sukunimi" class="col-sm-3 col-form-label">Sukunimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $sukunimi; ?>" name="sukunimi" class="form-control <?php echo (!empty($sukunimiError)) ? 'is-invalid' : ''; ?>" id="inputSukunimi">
              <?php if (!empty($sukunimiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $sukunimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="sahkoposti" class="col-sm-3 col-form-label">Sähköposti</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $sahkoposti; ?>" name="sahkoposti" class="form-control <?php echo (!empty($sahkopostiError)) ? 'is-invalid' : ''; ?>" id="inputSahkoposti">
              <?php if (!empty($sahkopostiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $sahkopostiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="lahiosoite" class="col-sm-3 col-form-label">Lähiosoite</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $lahiosoite; ?>" name="lahiosoite" class="form-control <?php echo (!empty($lahiosoiteError)) ? 'is-invalid' : ''; ?>" id="inputLahiosoite">
              <?php if (!empty($lahiosoiteError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $lahiosoiteError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="postinumero" class="col-sm-3 col-form-label">Postinumero</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $postinumero; ?>" name="postinumero" class="form-control <?php echo (!empty($postinumeroError)) ? 'is-invalid' : ''; ?>" id="inputPostinumero">
              <?php if (!empty($postinumeroError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $postinumeroError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="postitoimipaikka" class="col-sm-3 col-form-label">Postitoimipaikka</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $postitoimipaikka; ?>" name="postitoimipaikka" class="form-control <?php echo (!empty($postitoimipaikkaError)) ? 'is-invalid' : ''; ?>" id="inputPostitoimipaikka">
              <?php if (!empty($postitoimipaikkaError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $postitoimipaikkaError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="puhelin" class="col-sm-3 col-form-label">Puhelin</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $puhelin; ?>" name="puhelin" class="form-control <?php echo (!empty($puhelinError)) ? 'is-invalid' : ''; ?>" id="inputPuhelin">
              <?php if (!empty($puhelinError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $puhelinError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="henkilotunnus" class="col-sm-3 col-form-label">Henkilötunnus</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo $henkilotunnus; ?>" name="henkilotunnus" class="form-control <?php echo (!empty($henkilotunnusError)) ? 'is-invalid' : ''; ?>" id="inputHenkilotunnus">
              <?php if (!empty($henkilotunnusError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $henkilotunnusError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-12 text-center">
            <button class="btn btn-primary" type="submit">Tallenna</button>
            <a href="asiakas.php" class="btn btn-secondary">Takaisin</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>