<?php
/* ALOITUS */   
$display = "d-none";
$message = "";
$success = "success";
$sallittu = true;
$ilmoitukset['errorMsg'] = 'Salasanan vaihto epäonnistui. '; 
debuggeri("POST:".var_export($_POST,true));
$user_id = $_SESSION['user_id'] ?? 0;

if (!isset($_SESSION['user_id'])) {
    error_log("Käyttäjä ei ole kirjautunut sisään.");
    exit;
}



if (isset($_POST['painike']) && !$message) {
    [$errors, $values] = validointi($kentat);
    extract($values);

    if ($errors) {
        debuggeri($errors);
    } else {
        $query = "SELECT password FROM users WHERE id = ?";
        $stmt = $yhteys->prepare($query);
        if (!$stmt) {
            die("Tietokantayhteys ei toimi: " . $yhteys->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            debuggeri("$email:$virheilmoitukset[accountNotExistErr]");
            $message = $ilmoitukset['errorMsg'];
            $success = "danger";
            $display = "d-block";
        } else {
            $stmt->bind_result($password_hash);
            $stmt->fetch();

            if (password_verify($password, $password_hash)) {
                if (empty($errors['new_password2']) && empty($errors['new_password'])) {
                    if ($_POST['new_password'] != $_POST['new_password2']) {
                        $errors['new_password2'] = $virheilmoitukset['new_password2']['customError'];
                    }
                }

                debuggeri($errors);
                if (empty($errors)) {
                    $new_password_hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    $update_query = "UPDATE users SET password = ? WHERE id = ?";
                    $update_stmt = $yhteys->prepare($update_query);
                    if (!$update_stmt) {
                        echo "Virhe: " . $yhteys->error;
                        die();
                    }

                    $update_stmt->bind_param("si", $new_password_hash, $user_id);
                    $update_stmt->execute();

                    if ($update_stmt->affected_rows > 0) {
                        $message = "Sähköpostiosoite päivitetty onnistuneesti.";
                        $success = "success";
                        $display = "d-block";
                    } else {
                        $message = "Sähköpostin päivitys epäonnistui.";
                        $success = "danger";
                        $display = "d-block";
                    }
                }
            } else {
                $errors['password'] = $virheilmoitukset['PwdErr'];
            }
        }
    }
}
?>