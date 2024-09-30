<?php 
$title = 'Sähköpostiosoitteen vahvistus';
$navbar = false;
$css = "login.css";
//$css = 'kuvagalleria.css';
include "header.php"; 
include "activation.php";
?>



<div class="login_logo">
<a href="index.php">
<img src="pictures/BatmanCut.png" alt="Profiilikuva" class="profile-image">
</a>
</div>

<div class="container">
<form method="post" autocomplete="on" class="mb-3 needs-validation" novalidate>    
<fieldset>
<legend>Vahvistus</legend>

<?php echo $email_already_verified; ?>
<?php echo $email_verified; ?>
<?php echo $activation_error; ?>



<div class="div-button">
<a class="btn btn-lg btn-success" href="<?php echo "http://$PALVELIN/$PALVELU/login.php";?>">Kirjaudu</a>
</div>

</div>
</fieldset>
</form>

</div>
<?php include "footer.html"; ?>