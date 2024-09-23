<?php 
/* Huom. Tässä salasanakenttien täsmääminen tarkistetaan vain palvelimella. */
$tietokanta = "sarjakuva_seuranta";

$title = "register";
$navbar = false;
$css = "login.css";

$kentat = ['name','email','password','password2'];
$kentat_suomi = ['nimi','sähköpostiosoite','salasana','salasana'];
$pakolliset = ['name','email','password','password2'];

//$css = 'rekisteroityminen.css';
include "virheilmoitukset.php";
echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
include "header.php";
include "posti.php";
include "rekisterointi.php";
?>

<div class="login_logo">
<a href="index.php">
<img src="pictures/BatmanCut.png" alt="Profiilikuva" class="profile-image">
</a>
</div>


<div class="container"> 

<?php 
if ($success != "success") { ?>



<form method="post" class="mb-3 needs-validation" enctype="multipart/form-data" novalidate >
<fieldset>
<legend>Rekisteröityminen</legend>

<div class="row">
<label for="name" class="col-sm-4 form-label">Etunimi</label>
<div class="col-sm-8">
<input type="text" id="name" name="name" class="form-control <?= is_invalid('name'); ?>" title="Kirjoita name (väh. 2 merkkiä) ilman erikoismerkkejä" value="" 
pattern="<?= pattern("name"); ?>"
placeholder="name" value="<?= arvo("name"); ?>" 
       required autofocus> 
       <div class="invalid-feedback"><?= $errors['name'] ?? ""; ?> </div>
</div>
</div>   


<div class="row">
<label for="email" class="col-sm-4 form-label">Sähköpostiosoite</label>
<div class="col-sm-8">
<input type="email" class="mb-1 form-control <?= is_invalid('email'); ?>" name="email" id="email" 
       placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("email"); ?>"
       pattern="<?= pattern('email'); ?>" required>
<div class="invalid-feedback"><?= $errors['email'] ?? ""; ?>    </div>
</div>
</div>

<div class="row">
<label for="password" class="col-sm-4 form-label">Salasana</label>
<div class="col-sm-8">
<input type="password" class="mb-1 form-control <?= is_invalid('password'); ?>" name="password" id="password" 
       placeholder="salasana" pattern="<?= pattern('password'); ?>" required>
<div class="invalid-feedback">
<?= $errors['password'] ?? ""; ?>    
</div>
</div>
</div>

<div class="row">
<label for="password2" class="text-nowrap col-sm-4 form-label">Salasana uudestaan</label>
<div class="col-sm-8">
<input type="password" class="mb-1 form-control <?= is_invalid('password2'); ?>" name="password2" id="password2" 
       placeholder="salasana uudestaan" pattern="<?= pattern('password2'); ?>" required>
<div class="invalid-feedback">
<?= $errors['password2'] ?? ""; ?>    
</div>
</div>
</div>

<button name='painike' type="submit" class="mt-3 float-end btn btn-primary">Rekisteröidy</button>
</fieldset>

</form>

<?php } ?>

<div  id="ilmoitukset" class="alert alert-<?= $success ;?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

</div>

<?php
include 'footer.html';
?>
