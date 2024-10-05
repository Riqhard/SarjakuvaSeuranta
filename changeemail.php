<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";
include "debuggeri.php";
$loggedIn = secure_page();

  $css = "login.css";
  $navbar = false;
  $title = 'Change password';
  //$css = 'kuvagalleria.css';
  $kentat = ['email'];
  $kentat_suomi = ['sähköpostiosoite'];
  $pakolliset = ['email'];


include "virheilmoitukset.php";
include "kasittelija_changeemail.php";
echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
include 'header.php';
debuggeri($errors);

?>

<div class="login_logo">
<a href="index.php">
<img src="pictures/BatmanCut.png" alt="Profiilikuva" class="profile-image">
</a>
</div>




<div class="container"> 

<?php if (!$message) { ?>    
<form method="post" class="mb-3 needs-validation" novalidate>
<fieldset>
<legend>Uusi Sähköpostiosoite</legend>

<div class="row">
<label for="email" class="col-sm-4 form-label">Uusi Sähköpostiosoite</label>
<div class="col-sm-8">
<input type="email" class="mb-1 form-control <?= is_invalid('email'); ?>" name="email" id="email" 
       placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("email"); ?>"
       pattern="<?= pattern('email'); ?>" required>
<div class="invalid-feedback"><?= $errors['email'] ?? ""; ?>    </div>
</div>
</div>

<button name='painike' type="submit" class="mt-3 float-end btn btn-primary">Vaihda sähköposti</button>
</fieldset>

</form>
<?php } ?>
<div  id="ilmoitukset" class="alert alert-<?= $success ;?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


</div>
<?php include "footer.html"; ?>