<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";
$loggedIn = secure_page();
$title = 'Profiili';
include "header.php"; 
include "kasittelija_profiili.php";


$thisid = $_SESSION['user_id'];
if (isset($thisid)) {
    $sql = "SELECT firstname, email FROM users WHERE id = ?";
    $stmt = $yhteys->prepare($sql);
    $stmt->bind_param("i", $thisid);
    $stmt->execute();
    $stmt->bind_result($firstname, $email);
    $stmt->fetch();
    $stmt->close();

} else {
    $firstname = "Tuntematon";
    $email = "Tuntematon";
}

?>
<div id="sailio">

    <div class="uutis_otsikko">
        Profiili
    </div>

    <div id="sisalto">
        <div class="sisalto_otsikko">Tili tiedot:</div>
        <div>Name: <?php echo $firstname ?></div>
        <div>Email: <?php echo $email ?></div>

        <div class="sisalto_otsikko">Profiili kuva:</div>
        <img src="<?php echo htmlspecialchars($current_image, ENT_QUOTES, 'UTF-8'); ?>" width="300">



    </div>


    <div id="sisalto">
        <div class="sisalto_otsikko">Tietojen vaihto:</div>
    <a href="changename.php">Vaihda Nimi</a><br>
    <a href="changeprofilepicture.php">Vaihda profiili kuva</a><br>
    <a href="changeemail.php">Vaihda Sähköpostiosoite</a><br>
    <a href="changepassword.php">Vaihda Salasana</a><br>
    <a href='poistaprofiili.php?id=<?php echo $thisid; ?>' onclick='return confirm("Haluatko varmasti poistaa käyttäjän? Tätä toimintoa on pysyvä.")'>Poista Profiili</a>
    </div>

</div>
<?php include "footer.html"; ?>