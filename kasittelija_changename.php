<?php
/* ALOITUS */   
$display = "d-none";
$message = "";
$success = "success";
$sallittu = true;
$ilmoitukset['errorMsg'] = 'Nimen vaihto epäonnistui. '; 
debuggeri("POST:".var_export($_POST,true));
$user_id = $_SESSION['user_id'] ?? 0;

if (!isset($_SESSION['user_id'])) {
    error_log("Käyttäjä ei ole kirjautunut sisään.");
    exit;
}


if (isset($_POST['painike']) and !$message){
    [$errors,$values] = validointi($kentat);
    extract($values);

    if ($errors) {
        debuggeri($errors);
    } else {

        if (empty($errors)) {  
            $query = "SELECT name FROM users WHERE id = ?";
            $stmt = $yhteys->prepare($query);
            if (!$stmt) {
                die("Tietokantayhteys ei toimi: " . $yhteys->error);
            }

            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows === 0) {
                debuggeri("$user_id: Käyttäjää ei löydy.");
                $message = $ilmoitukset['errorMsg'];
                $success = "danger";
                $display = "d-block";
            } else {

                $stmt->bind_result($current_name);
                $stmt->fetch();

                // Päivitä nimi
                $update_query = "UPDATE users SET name = ? WHERE id = ?";
                $update_stmt = $yhteys->prepare($update_query);
                if (!$update_stmt) {
                    die("Tietokantayhteys ei toimi: " . $yhteys->error);
                }

                $update_stmt->bind_param("si", $name, $user_id);
                $update_stmt->execute();

                if ($update_stmt->affected_rows > 0) {
                    $message = "Nimen päivitys onnistui.";
                    $success = "success";
                    $display = "d-block";
                } else {
                    $message = "Nimen päivitys epäonnistui.";
                    $success = "danger";
                    $display = "d-block";
                }
            }
            
        }
    }

 
 }
?>