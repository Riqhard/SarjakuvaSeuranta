<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";

$loggedIn = secure_page();
$title = 'Haku';
include "header.php"; 
include "kasittelija_marvelHaku.php"; 
?>


<?php include "footer.html"; ?>