<?php
/* 
1. Unohditko salasanan -linkki (forgotpassword.php) kirjautumislomakkeella (login.php).
2. forgotpassword.php -lomake ja kasittelija_forgotpassword.php 
3. salasanan asettamislinkki (resetpassword.php) ja resetpassword-token sähköpostilla
4. resetpassword.php -lomake ja kasittelija_resetpassword.php
*/
$css = "login.css";
$title = "Unohtunut salasana";
$kentat = ['email'];
$kentat_suomi = ['sähköpostiosoite'];
$pakolliset = ['email'];
include "virheilmoitukset.php";
echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
include('header.php');
include('posti.php');
include('kasittelija_forgotpassword.php');
?>

<div class="login_logo">
<a href="index.php">
<img src="pictures/BatmanCut.png" alt="Profiilikuva" class="profile-image">
</a>
</div>


<div class="container">

<form method="post" autocomplete="on" novalidate class="needs-validation">
<fieldset>
<legend>Unohtunut salasana</legend>

<div class="row">
<label for="email" class="col-sm-4 form-label">Sähköpostiosoite</label>
<div class="col-sm-8">
<input type="email" class="mb-1 form-control <?= is_invalid('email'); ?>" name="email" id="email" 
       placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("email"); ?>"
       pattern="<?= pattern('email'); ?>" autofocus required>
<div class="invalid-feedback">
<?= $errors['email'] ?? ""; ?>    
</div>
</div>
</div>

<div class="div-button">
<input type="submit" name="painike" class="offset-sm-4 mt-3 mb-2 btn btn-primary" value="Lähetä linkki">  
</div>
</fieldset>
</form>
</div>

<div id="ilmoitukset" class="alert alert-<?= $success ;?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<?php
include('footer.html');
?>