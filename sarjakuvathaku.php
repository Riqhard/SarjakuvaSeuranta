<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";

$loggedIn = secure_page();
$title = 'Haku';
include "header.php"; 
?>

<div id="sailio">

    <div class="uutis_otsikko">
    <h1>Hae Sarjakuvia</h1>
    </div>


    <div class="uutis_otsikko">
        <h1>Hakutulokset</h1>
        <form method="POST" action="sarjakuvathaku.php">
            <label for="search">Hakusana:</label>
            <input type="text" id="search" name="search">
            <button type="submit">Hae</button>
        </form>
    </div>


    <ul id="results">
    <?php 
    include "kasittelija_sarjakuvathaku.php";?>
    </ul>

</div>


<?php
include "footer.html"; ?>