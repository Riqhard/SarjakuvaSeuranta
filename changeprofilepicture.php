<?php 
// ob_start();
include "asetukset.php";
include "debuggeri.php";
include "db.php";
include "rememberme.php";
$loggedIn = secure_page();

$css = "login.css";
$navbar = false;
$title = 'Vaihda Profiili kuva';

$kentat_tiedosto = ['image'];
$kentat = ['imgname','current_image'];
$kentat_suomi = ['kuvaname','kuva'];
$pakolliset = ['imgname'];
include "virheilmoitukset.php";
include "kasittelija_kuvanvaihto.php";
echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
include "header.php"; 
/* Huom. current_image sisältää profiilikuvatiedoston 
   alkuperäisen nimen. Tässä profiilia tallennettaessa vanha
   kuva poistetaan ja uusi tallennetaan tilalle. */
?>

<div class="login_logo">
<a href="index.php">
<img src="pictures/BatmanCut.png" alt="Profiilikuva" class="profile-image">
</a>
</div>




<div class="container"> 

<?php if (!$message) { ?>    
<form method="post" class="mb-3 needs-validation" enctype="multipart/form-data" novalidate>
<fieldset>
<legend>Profiilikuva</legend>

<div class="row">
<label for="imgname" class="col-sm-4 form-label">Kuvan nimi</label>
<div class="col-sm-8">
<input type="name" class="mb-1 form-control <?= is_invalid('imgname'); ?>" name="imgname" id="imgname" 
       placeholder="Nimi" value="<?= arvo("imgname"); ?>"
       pattern="<?= pattern('imgname'); ?>" required>
<div class="invalid-feedback"><?= $errors['imgname'] ?? ""; ?>    </div>
</div>
</div>


<div class="row mb-sm-1">
<label for="image" class="form-label mb-0 col-sm-2">Kuva</label>
<div class="col-sm-8">
<input id="image" name="image" type="file" accept="image/*" pattern="<?= pattern('image'); ?>" class="form-control <?= is_invalid('image'); ?> " placeholder="kuva"></input>
<div class="invalid-feedback">
<?= $errors['image'] ?? ""; ?>
</div>
<div class="previewDiv mt-1 col-sm-8 d-none" id="previewDiv">
<img class="previewImage" src="" id="previewImage" width="" height="">
<br>
<button type="button" class="btn btn-outline-secondary float-end btn-sm mt-1" onclick="tyhjennaKuva('image')">Poista</button>
</div>
</div>
</div>

<input type="submit" name="nappula" class="btn btn-primary" value="Tallenna">
</fieldset>
</form>




<?php } ?>
<div  id="ilmoitukset" class="alert alert-<?= $success ;?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


</div>
<?php include "footer.html"; ?>