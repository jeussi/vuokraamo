<?php
include_once 'inc/header.php';
?>

<div class="container">
  <div class="row">
    <h3>Tuotetiedot</h3>
  </div>

  <div class="row">
    <p>
      <a href="lisaa_tuote.php" class="btn btn-success">Lisää tuote</a>
    </p>
  </div>

  <div class="row">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nimi</th>
          <th>Kpl</th>
          <th>Painoraja</th>
          <th>Kuva</th>
          <th>Toiminnot</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Luodaan yhteys tietokantaan ja haetaan tuotetiedot
        require_once 'inc/database.php';
        $sql = "SELECT * FROM tuote";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) :
        ?>
          <tr>
            <td><?php echo $row['tuoteID']; ?></td>
            <td><?php echo $row['nimi']; ?></td>
            <td><?php echo $row['kpl']; ?></td>
            <td><?php echo $row['painoraja']; ?></td>
            <td><?php echo $row['kuva']; ?></td>
            <td>
              <a href="poista_tuote.php?tuoteID=<?php echo $row['tuoteID']; ?>" class="btn btn-sm btn-danger">Poista</a>
              <a href="paivita_tuote.php?tuoteID=<?php echo $row['tuoteID']; ?>" class="btn btn-sm btn-success">Päivitä</a>
              <a href="katso_tuote.php?tuoteID=<?php echo $row['tuoteID']; ?>" class="btn btn-sm btn-secondary">Katso</a>
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