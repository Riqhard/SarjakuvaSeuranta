<?php

include_once "debuggeri.php";
/* Huom. suojatulla sivulla on asetukset,db,rememberme.php; */
if (!isset($loggedIn)){
  require "asetukset.php";
  include "db.php";
  include "rememberme.php";
  $loggedIn = loggedIn();
  }
  debuggeri("POST:".var_export($_POST,true));
  $user_id = $_SESSION['user_id'] ?? 0;
  
  if (!isset($_SESSION['user_id'])) {
      error_log("Käyttäjä ei ole kirjautunut sisään.");
      exit;
  }



// Tarkistetaan, onko ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Varmistetaan, että ID on kokonaisluku

    if ($id == 1) {
        echo "Adminin poisto ei ole sallittua.";
        exit();
    }
    if ($id != $user_id) {
        echo "Et voi poistaa muutakuin oman profiilin.";
        exit();
    }

    // Poista käyttäjä tietokannasta
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $yhteys->prepare($query);
    if (!$stmt) {
        die("Tietokantayhteys ei toimi: " . $yhteys->error);
    }

    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Käyttäjän poisto epäonnistui: " . $stmt->error);
    }
   
    // Uudelleenohjataan takaisin pääsivulle
    header("Location: index.php");
    exit();
} else {
    echo "ID:tä ei ole asetettu.";
    exit();
}
?>