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
  $kentat = ['password','password2'];
  $kentat_suomi = ['salasana','salasana'];
  $pakolliset = ['password','password2'];


include "virheilmoitukset.php";
include "kasittelija_changepassword.php";
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
<legend>Uusi salasana</legend>

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
<button name='painike' type="submit" class="mt-3 float-end btn btn-primary">Tallenna salasana</button>
</fieldset>

</form>
<?php } ?>
<div  id="ilmoitukset" class="alert alert-<?= $success ;?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


</div>
<?php include "footer.html"; ?>