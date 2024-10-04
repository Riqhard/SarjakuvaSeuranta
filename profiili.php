<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";
$loggedIn = secure_page();
$title = 'Profiili';
include "header.php"; 


$thisid = $_SESSION['user_id'];
if (isset($thisid)) {
    $sql = "SELECT name, email FROM users WHERE id = ?";
    $stmt = $yhteys->prepare($sql);
    $stmt->bind_param("i", $thisid);
    $stmt->execute();
    $stmt->bind_result($name, $email);
    $stmt->fetch();
    $stmt->close();

} else {
    $name = "Tuntematon";
    $email = "Tuntematon";
}

?>
<div id="sailio">

    <div class="uutis_otsikko">
        Profiili
    </div>

    <div id="sisalto">
        <div class="sisalto_otsikko">Nimi:</div>
        <div><?php echo $name ?></div>
    </div>

    <div id="sisalto">
        <div class="sisalto_otsikko">Email:</div>
        <div> <?php echo $email ?></div>
    </div>

    <div id="sisalto">
    <a href="changepassword.php">Change Name</a><br>
    <a href="changepassword.php">Change Email</a><br>
    <a href="changepassword.php">Change password</a><br>
    <a href="changepassword.php">Remove profile</a>
    </div>

</div>
<?php include "footer.html"; ?>