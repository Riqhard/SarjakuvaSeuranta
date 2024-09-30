<?php
$display = "d-none";
$message = "";
$success = "success";

if (isset($_SESSION['user_id'])) {
    echo "Käyttäjä on kirjautunut sisään, ID: " . $_SESSION['user_id'] . "<br><br>";
    $user_id = $_SESSION['user_id'];
} else {
    echo "Käyttäjä ei ole kirjautunut sisään.<br><br>";
    $user_id = "";
}



if (isset($_POST['painike']) and !$message){
    [$errors,$values] = validointi($kentat);
    extract($values);
 
     if (empty($errors['password2']) and empty($errors['password'])) {
         if ($_POST['password'] != $_POST['password2']) {
             $errors['password2'] = $virheilmoitukset['password2']['customError'];
             }
         }
         
     debuggeri($errors);    
     if (empty($errors)) {
         $password = password_hash($password, PASSWORD_DEFAULT);
         $query = "UPDATE users SET password = '$password' WHERE id = $user_id";
         if (!$yhteys->query($query)) {
            echo "Virhe: ".$yhteys->error;
            die();
            }
         $result = $yhteys->query($query);
         $muutettu = $yhteys->affected_rows;
                  /* Huom. tässä siirrytään suoraan kirjautumissivulle. */
                  header("location: login.php");
                  exit;
         }
 
 }
?>