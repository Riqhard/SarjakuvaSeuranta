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
  $kentat = ['password','new_password', 'new_password2'];
  $kentat_suomi = ['salasana','uusi_salasana', 'uusi_salasana uudestaan'];
  $pakolliset = ['password','new_password', 'new_password2'];


include "virheilmoitukset.php";
include "kasittelija_changepassword.php";
echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
include 'header.php';
debuggeri($errors);

?>

<div class="login_logo">
<a href="profiili.php">
<img src="pictures/BatmanCut.png" alt="Profiilikuva" class="profile-image">
</a>
</div>




<div class="container"> 

<?php if (!$message) { ?>    
<form method="post" class="mb-3 needs-validation" novalidate>
<fieldset>
<legend>Salasanan vaihto</legend>

<div class="row">
<label for="password" class="col-sm-4 form-label">Nykyinen Salasana</label>
<div class="col-sm-8">
<input type="password" class="mb-1 form-control <?= is_invalid('password'); ?>" name="password" id="password" 
       placeholder="Salasana" pattern="<?= pattern('password'); ?>" required>
<div class="invalid-feedback">
<?= $errors['password'] ?? ""; ?>    
</div>
</div>
</div>


<div class="row">
<label for="new_password" class="col-sm-4 form-label">Uusi Salasana</label>
<div class="col-sm-8">
<input type="password" class="mb-1 form-control <?= is_invalid('new_password'); ?>" name="new_password" id="new_password" 
       placeholder="Uusi salasana" pattern="<?= pattern('new_password'); ?>" required>
<div class="invalid-feedback">
<?= $errors['new_password'] ?? ""; ?>    
</div>
</div>
</div>

<div class="row">
<label for="new_password2" class="text-nowrap col-sm-4 form-label">Uusi Salasana uudestaan</label>
<div class="col-sm-8">
<input type="password" class="mb-1 form-control <?= is_invalid('new_password2'); ?>" name="new_password2" id="new_password2" 
       placeholder="Uusi salasana uudelleen" pattern="<?= pattern('new_password2'); ?>" required>
<div class="invalid-feedback">
<?= $errors['new_password2'] ?? ""; ?>    
</div>
</div>
</div>
<button name='painike' type="submit" class="mt-3 float-end btn btn-primary">Tallenna uusi salasana</button>
</fieldset>

</form>
<?php } ?>
<div  id="ilmoitukset" class="alert alert-<?= $success ;?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


</div>
<?php include "footer.html"; ?>