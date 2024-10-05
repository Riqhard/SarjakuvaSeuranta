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
  $kentat = ['name'];
  $kentat_suomi = ['nimi'];
  $pakolliset = ['name'];


include "virheilmoitukset.php";
include "kasittelija_changename.php";
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
<legend>Uusi nimi</legend>

<div class="row">
<label for="name" class="col-sm-4 form-label">Uusi nimi</label>
<div class="col-sm-8">
<input type="name" class="mb-1 form-control <?= is_invalid('name'); ?>" name="name" id="name" 
       placeholder="etunimi.sukunimi@palvelu.fi" value="<?= arvo("name"); ?>"
       pattern="<?= pattern('name'); ?>" required>
<div class="invalid-feedback"><?= $errors['name'] ?? ""; ?>    </div>
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