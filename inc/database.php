<?php

try {
  $pdo = new PDO(
    "mysql:host=localhost; dbname=vuokraamo",
    "vuokraamo",
    "briDGsgIqL@YQijA"
  );

  $pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
  );
} catch (PDOException $e) {
  die("ERROR: Ei voitu yhdistää tietokantaan. " .
    $e->getMessage());
}
