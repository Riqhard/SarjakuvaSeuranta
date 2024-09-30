<?php

include_once "debuggeri.php";
/* Huom. suojatulla sivulla on asetukset,db,rememberme.php; */
if (!isset($loggedIn)){
  require "asetukset.php";
  include "db.php";
  include "rememberme.php";
  $loggedIn = loggedIn();
  }
debuggeri("loggedIn:$loggedIn");  
register_shutdown_function('debuggeri_shutdown');
$active = basename($_SERVER['PHP_SELF'], ".php");



// Tarkistetaan, onko ID ja kuva asetettu
if (isset($_GET['id']) && isset($_GET['image'])) {
    $id = $_GET['id'];
    $image = urldecode($_GET['image']);

    // Poista sarjakuva tietokannasta
    $query = "DELETE FROM sarjakuvat WHERE sarjakuva_id = ?";
    $stmt = $yhteys->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();


    if ($image != "placeholder.png") {
    // Poistetaan kuvatiedosto Sarjakuvat-hakemistosta, jos se on olemassa
    $imagePath = "sarjakuvien_kuvat/" . $image;
        if (file_exists($imagePath)) {
            unlink($imagePath);  // Poistaa tiedoston
        }
    }
   
    // Uudelleenohjataan takaisin hakusivulle
    header("Location: sarjakuvathaku.php");
    exit();
} else {
    echo "ID tai kuva ei ole asetettu.";
    exit();
}
?>