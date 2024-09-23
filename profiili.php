<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";
$loggedIn = secure_page();
$title = 'Profiili';
include "header.php"; 
?>
<div id="sailio">

    <div id="uutis_otsikko">
        Profiili
    </div>

    <div id="sisalto">
        <div class="sisalto_otsikko">Nimi:</div>
        <div>Matti Meikäläinen</div>
    </div>

    <div id="sisalto">
        <div class="sisalto_otsikko">Ammatti:</div>
        <div>Ohjelmistokehittäjä</div>
    </div>

    <div id="sisalto">
        <div class="sisalto_otsikko">Yhteystiedot:</div>
        <div>Email: matti.meikäläinen@example.com</div>
        <div>Puhelin: 040-1234567</div>
    </div>

    <div id="sisalto">
        <div class="sisalto_otsikko">Harrastukset:</div>
        <ul class="hobbies-list">
        <li>Koodaus</li>
        <li>Valokuvaus</li>
        <li>Matkustelu</li>
        <li>Lukeminen</li>
        </ul>
    </div>

</div>
<?php include "footer.html"; ?>