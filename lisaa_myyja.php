<?php
include_once 'inc/header.php';
include_once 'inc/database.php';

if (!empty($_POST)) {

  $nimi = $_POST['nimi'];
  $kayttajatunnus = $_POST['kayttajatunnus'];
  $rooli = $_POST['rooli'];
  $salasana = $_POST['salasana'];


  //tarkistetaan tietojen oikeellisuus

  $valid = true;

  if ($valid) {

    $sql = "INSERT INTO myyja (nimi, kayttajatunnus, rooli, salasana) VALUES (:nimi, :kayttajatunnus, :rooli, :salasana)";

    $salasana = password_hash($salasana, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nimi', $nimi);
    $stmt->bindParam(':kayttajatunnus', $kayttajatunnus);
    $stmt->bindParam(':rooli', $rooli);
    $stmt->bindParam(':salasana', $salasana);

    $stmt->execute();

    header("Location: myyja.php");
    exit;
  }
} else {

  //yleiset ohjetekstit
  $nimiError = 'Syötä nimi';
  $kayttajatunnusError = 'Syötä käyttäjätunnus';
  $rooliError = 'Syötä rooli';
  $salasanaError = 'Syötä salasana';
}

?>
<div class="container">
  <div class="row">
    <div class="col-8 mx-auto">
      <div class="card card-body bg-light mt-3">
        <h3>Myyjän tietojen lisääminen</h3>

        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
          <div class="mb-3">
            <label for="nimi" class="form-label">Nimi</label>
            <input type="text" value="<?php echo (!empty($nimi)) ? $nimi : ''; ?>" class="form-control
          <?php echo (!empty($_POST) && !empty($nimiError)) ? 'is-invalid' : ''; ?>" id="nimi" name="nimi" aria-describedby="" required>
            <div class="invalid-feedback">
              <small><?php echo $nimiError ?? ''; ?></small>
            </div>
          </div>

          <div class="mb-3">
            <label for="kayttajatunnus" class="form-label">Käyttäjätunnus</label>
            <input type="text" value="<?php echo (!empty($kayttajatunnus)) ? $kayttajatunnus : ''; ?>" class="form-control
          <?php echo (!empty($_POST) && !empty($kayttajatunnusError)) ? 'is-invalid' : ''; ?>" id="kayttajatunnus" name="kayttajatunnus" aria-describedby="" required>
            <div class="invalid-feedback">
              <small><?php echo $kayttajatunnusError ?? ''; ?></small>
            </div>
          </div>

          <div class="mb-3">
            <label for="rooli" class="form-label">Rooli</label>
            <input type="text" value="<?php echo (!empty($rooli)) ? $rooli : ''; ?>" class="form-control
          <?php echo (!empty($_POST) && !empty($rooliError)) ? 'is-invalid' : ''; ?>" id="rooli" name="rooli" aria-describedby="" required>
            <div class="invalid-feedback">
              <small><?php echo $rooliError ?? ''; ?></small>
            </div>
          </div>

          <div class="mb-3">
            <label for="salasana" class="form-label">Salasana</label>
            <input type="password" value="<?php echo (!empty($salasana)) ? $salasana : ''; ?>" class="form-control
          <?php echo (!empty($_POST) && !empty($salasanaError)) ? 'is-invalid' : ''; ?>" id="salasana" name="salasana" aria-describedby="" required>
            <div class="invalid-feedback">
              <small><?php echo $salasanaError ?? ''; ?></small>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Tallenna</button>
          <a href="myyja.php" class="btn btn-secondary float-end">Takaisin</a>


        </form>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>