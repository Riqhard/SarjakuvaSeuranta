<?php 
include "asetukset.php";
include "db.php";
include "rememberme.php";

$title = 'Sarjakuva lisäys';
$kentat = ['title', 'description', 'chapters'];
$kentat_suomi = ['titteli', 'kuvaus', 'luvut'];
$pakolliset = ['title', 'description', 'chapters'];
$kentat_tiedosto = ['image'];
$loggedIn = secure_page();

include "virheilmoitukset.php";
echo "<script>const virheilmoitukset = $virheilmoitukset_json</script>";
include "header.php"; 
include "sarjakuvalisays.php";
?>
<div id="sailio">


<?php 
if ($success != "success") { ?>

<div class="uutis_otsikko">
<form method="post" class="mb-3 needs-validation" enctype="multipart/form-data" novalidate >
<fieldset>
<legend>Sarjakuvien lisäys</legend>

<div class="row">
<label for="title" class="col-sm-4 form-label">Sarjakuvan Nimi</label>
<div class="col-sm-8">
<input pattern="<?= pattern("title"); ?>" type="text" class="mb-1 form-control <?= is_invalid('title'); ?>" name="title" id="title" 
       placeholder="Sarjakuvan nimi" value="<?= arvo("title"); ?>" 
       required autofocus> 
<div class="invalid-feedback">
<?= $errors['title'] ?? ""; ?>    
</div>
</div>    
</div>

<div class="row mb-sm-1">
    <label for="description" class="form-label mb-0 col-sm-4">Kuvaus</label>
    <div class="col-sm-8">
    <textarea id="description" name="description" class="form-control <?= is_invalid('description'); ?>" placeholder="Kuvaus" rows="3"><?= arvo("description"); ?></textarea>
    <div class="invalid-feedback">
    <?= $errors['description'] ?? ""; ?>
    </div>
    </div>
</div>

<div class="row">
    <label for="chapters" class="col-sm-4 form-label">Sivumäärä</label>
    <div class="col-sm-8">
    <input type="number" class="mb-1 form-control <?= is_invalid('chapters'); ?>" name="chapters" id="chapters" 
           placeholder="0" value="<?= arvo("chapters"); ?>"
           pattern="<?= pattern('chapters'); ?>" required>
    <div class="invalid-feedback">
    <?= $errors['chapters'] ?? ""; ?>
    </div>
    </div>
</div>



<div class="row mb-sm-1">
<label for="image" class="form-label mb-0 col-sm-4">Kuva</label>
<div class="col-sm-8">
<input id="image" name="image" type="file" accept="image/*" pattern="<?= pattern('image'); ?>" class="form-control <?= is_invalid('image'); ?>" placeholder="kuva"></input>
<div class="invalid-feedback">
<?= $errors['image'] ?? ""; ?>
</div>
<div class="previewDiv mt-1 col-sm-8 d-none" id="previewDiv">
<img class="previewImage" src="" id="previewImage" width="" height="">
<button type="button" class="btn btn-outline-secondary btn-sm float-end mt-1" onclick="tyhjennaKuva('image')">Poista</button>
</div>
</div>
</div>


<button name='nappula' type="submit" class="mt-3 float-end btn btn-primary">Lisää sarjakuva</button>
</fieldset>
</form>
</div>

<?php } ?>

<div  id="ilmoitukset" class="alert alert-<?= $success ;?> alert-dismissible fade show <?= $display ?? ""; ?>" role="alert">
<p><?= $message; ?></p>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


</div>
<?php include "footer.html"; ?>