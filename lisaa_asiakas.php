<?php
if (!empty($_POST)) {
  $henkilotunnus = $_POST['henkilotunnus'];
  $etunimi = $_POST['etunimi'];
  $sukunimi = $_POST['sukunimi'];
  $sahkoposti = $_POST['sahkoposti'];
  $lahiosoite = $_POST['lahiosoite'];
  $postinumero = $_POST['postinumero'];
  $postitoimipaikka = $_POST['postitoimipaikka'];
  $puhelin = $_POST['puhelin'];

  $henkilotunnusError = '';
  $etunimiError = '';
  $sukunimiError = '';
  $sahkopostiError = '';
  $lahiosoiteError = '';
  $postinumeroError = '';
  $postitoimipaikkaError = '';
  $puhelinError = '';

  $valid = true;

  if (empty($henkilotunnus)) {
    $valid = false;
    $henkilotunnusError = 'Syötä henkilötunnus';
  }

  if (empty($etunimi)) {
    $valid = false;
    $etunimiError = 'Syötä etunimi';
  }

  if (empty($sukunimi)) {
    $valid = false;
    $sukunimiError = 'Syötä sukunimi';
  }

  if (empty($sahkoposti)) {
    $valid = false;
    $sahkopostiError = 'Syötä sähköposti';
  }

  if (empty($lahiosoite)) {
    $valid = false;
    $lahiosoiteError = 'Syötä lähiosoite';
  }

  if (empty($postinumero)) {
    $valid = false;
    $postinumeroError = 'Syötä postinumero';
  }

  if (empty($postitoimipaikka)) {
    $valid = false;
    $postitoimipaikkaError = 'Syötä postitoimipaikka';
  }

  if (empty($puhelin)) {
    $valid = false;
    $puhelinError = 'Syötä puhelin';
  }

  if ($valid) {
    require_once 'inc/database.php';

    $sql = "INSERT INTO asiakas (henkilotunnus, etunimi, sukunimi, sahkoposti, lahiosoite, postinumero, postitoimipaikka, puhelin) 
    VALUES (:henkilotunnus, :etunimi, :sukunimi, :sahkoposti, :lahiosoite, :postinumero, :postitoimipaikka, :puhelin)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':henkilotunnus', $henkilotunnus, PDO::PARAM_STR);
    $stmt->bindParam(':etunimi', $etunimi, PDO::PARAM_STR);
    $stmt->bindParam(':sukunimi', $sukunimi, PDO::PARAM_STR);
    $stmt->bindParam(':sahkoposti', $sahkoposti, PDO::PARAM_STR);
    $stmt->bindParam(':lahiosoite', $lahiosoite, PDO::PARAM_STR);
    $stmt->bindParam(':postinumero', $postinumero, PDO::PARAM_STR);
    $stmt->bindParam(':postitoimipaikka', $postitoimipaikka, PDO::PARAM_STR);
    $stmt->bindParam(':puhelin', $puhelin, PDO::PARAM_STR);
    $stmt->execute();

    header("Location: asiakas.php");
    exit;
  }
}
?>

<?php
include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Asiakastietojen lisääminen</h3>

        <form action="lisaa_asiakas.php" method="POST" class="mt-3">

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="etunimi">Etunimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($etunimi)) ? $etunimi : ''; ?>" name="etunimi" class="form-control
              <?php echo (!empty($etunimiError)) ? 'is-invalid' : ''; ?>" id="inputEtunimi">
              <?php if (!empty($etunimiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $etunimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="sukunimi">Sukunimi</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($sukunimi)) ? $sukunimi : ''; ?>" name="sukunimi" class="form-control
              <?php echo (!empty($sukunimiError)) ? 'is-invalid' : ''; ?>" id="inputSukunimi">
              <?php if (!empty($sukunimiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $sukunimiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="sahkoposti">Sähköposti</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($sahkoposti)) ? $sahkoposti : ''; ?>" name="sahkoposti" class="form-control
              <?php echo (!empty($sahkopostiError)) ? 'is-invalid' : ''; ?>" id="inputSahkoposti">
              <?php if (!empty($sahkopostiError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $sahkopostiError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="lahiosoite">Lähiosoite</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($lahiosoite)) ? $lahiosoite : ''; ?>" name="lahiosoite" class="form-control
              <?php echo (!empty($lahiosoiteError)) ? 'is-invalid' : ''; ?>" id="inputLahiosoite">
              <?php if (!empty($lahiosoiteError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $lahiosoiteError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="postinumero">Postinumero</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($postinumero)) ? $postinumero : ''; ?>" name="postinumero" class="form-control
              <?php echo (!empty($postinumeroError)) ? 'is-invalid' : ''; ?>" id="inputPostinumero">
              <?php if (!empty($postinumeroError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $postinumeroError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="postitoimipaikka">Postitoimipaikka</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($postitoimipaikka)) ? $postitoimipaikka : ''; ?>" name="postitoimipaikka" class="form-control
              <?php echo (!empty($postitoimipaikkaError)) ? 'is-invalid' : ''; ?>" id="inputPostitoimipaikka">
              <?php if (!empty($postitoimipaikkaError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $postitoimipaikkaError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="puhelin">Puhelin</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($puhelin)) ? $puhelin : ''; ?>" name="puhelin" class="form-control
              <?php echo (!empty($puhelinError)) ? 'is-invalid' : ''; ?>" id="inputPuhelin">
              <?php if (!empty($puhelinError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $puhelinError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-3 col-form-label" for="henkilotunnus">Henkilötunnus</label>
            <div class="col-sm-9">
              <input type="text" value="<?php echo (!empty($henkilotunnus)) ? $henkilotunnus : ''; ?>" name="henkilotunnus" class="form-control
              <?php echo (!empty($henkilotunnusError)) ? 'is-invalid' : ''; ?>" id="inputHenkilotunnus">
              <?php if (!empty($henkilotunnusError)) : ?>
                <div class="invalid-feedback">
                  <small><?php echo $henkilotunnusError; ?></small>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3">Lisää asiakas</button>
            <a href="asiakas.php" class="btn btn-secondary mt-3 float-end">Takaisin</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>