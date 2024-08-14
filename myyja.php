<?php
include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <h3>Myyjätiedot</h3>
  </div>

  <div class="row">
    <p>
      <a href="lisaa_myyja.php" class="btn btn-success">Lisää myyja</a>
    </p>
  </div>

  <div class="row">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nimi</th>
          <th>Rooli</th>
          <th>Toiminnot</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Luodaan yhteys tietokantaan ja haetaan myyjatiedot

        require_once 'inc/database.php';
        $sql = "SELECT * FROM myyja";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) :
        ?>
          <tr>
            <td><?php echo $row['myyjaID']; ?></td>
            <td><?php echo $row['nimi']; ?></td>
            <td><?php echo $row['rooli']; ?></td>
            <td>
              <a href="poista_myyja.php?myyjaID=<?php echo $row['myyjaID']; ?>" class="btn btn-sm btn-danger">Poista</a>
              <a href="paivita_myyja.php?myyjaID=<?php echo $row['myyjaID']; ?>" class="btn btn-sm btn-success">Päivitä</a>
              <a href="katso_myyja.php?myyjaID=<?php echo $row['myyjaID']; ?>" class="btn btn-sm btn-secondary">Katso</a>
            </td>
          </tr>
        <?php endwhile;
        unset($result);
        unset($pdo);
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
include_once 'inc/footer.php';
?>