<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";

$loggedIn = secure_page();
$title = 'Haku';
$js = 'hakujs.js';
include "header.php"; 
?>

<div id="sailio">

    <div class="uutis_otsikko">
        Haku
    </div>


<div class="uutis_otsikko">

<h1>Hakutulokset</h1>
<input type="text" id="search" placeholder="Hae sarjakuvia..." onkeyup="filterResults()">
    <ul id="results">

    </ul>

    

</div>
</div>
<?php include "footer.html"; ?>