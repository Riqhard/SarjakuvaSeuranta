<?php
/* ALOITUS */   
$user_id = $_SESSION['user_id'] ?? 0;
$display = $_SESSION["display"] ?? "d-none";
$message = $_SESSION["message"] ?? "";
$success = $_SESSION["success"] ?? "success";
$kuvatiedosto = $_SESSION['kuvatiedosto'] ?? "";
$current_image = $_SESSION['current_image'] ?? "";
unset($_SESSION['display']);
unset($_SESSION['message']);
unset($_SESSION['success']);
unset($_SESSION['current_image']);
unset($_SESSION['kuvatiedosto']); 
debuggeri("user_id:$user_id", "current_image:$current_image", "kuvatiedosto:$kuvatiedosto");

function poista_tunniste($image){
    // Poistaa alaviivan ja sen perässä olevan tunnisteen ennen tiedostotyyppiä
    return preg_replace('/_[^_]+\.(jpg|jpeg|png|gif)$/i', '.$1', $image);
}
 function poista_kuva($image){
    $kuvatiedosto = PROFIILIKUVAKANSIO."/".$image;
    if (file_exists($kuvatiedosto)) unlink($kuvatiedosto);
}
    
function vanha_kuva($user_id){
    $query = "SELECT image FROM users WHERE id = $user_id";
    $result = mysqli_my_query($query);
    return ($row = $result->fetch_row()) ? $row[0] : "";
}
    
function poista_vanha_kuva($user_id){
    $image = vanha_kuva($user_id);
    if ($image) poista_kuva($image);
}    

function hae_kuva($kentat_tiedosto){  
    /* Huom. foreach-silmukka on tässä malliksi, ei valmis.
       Nimen tarkistukseen ei ole tässä koodia. */
        // $kentat_tiedosto = $GLOBALS['kentat_tiedosto'];   
        $allowed_images = $GLOBALS['allowed_images'];
        $virhe = false;   
        $image = "";
        foreach ($kentat_tiedosto as $kentta){
            if (!isset($_FILES[$kentta])) continue;   
            if (is_uploaded_file($_FILES[$kentta]['tmp_name'])) {
            $random = randomString(3);
            $maxsize = PROFIILIKUVAKOKO;
            $temp_file = $_FILES[$kentta]["tmp_name"];       
            $filesize = $_FILES[$kentta]['size'];
            $pathinfo = pathinfo($_FILES[$kentta]["name"]);
            $filetype = strtolower($pathinfo['extension']);
            $image = $pathinfo['filename']."_$random.$filetype";
            $target_dir = PROFIILIKUVAKANSIO;
            $target_file = "$target_dir/$image";
            debuggeri("tiedosto:$temp_file, kohde:$target_file");
            debuggeri("tiedostotyyppi:$filetype, koko:$filesize");
            /* Check if image file is a actual image or fake image */
            if (!$check = getimagesize($temp_file)) $virhe = "Kuva ei kelpaa.";
            elseif (file_exists($target_file)) $virhe = "Kuvatiedosto on jo olemassa.";
            elseif (!in_array($filetype,$allowed_images)) $virhe = "Väärä tiedostotyyppi.";
            elseif ($filesize > $maxsize) $virhe = "Kuvan koon tulee olla korkeintaan 10 MB.";
            debuggeri("File $image,mime: {$check['mime']}, $filetype, $filesize tavua");
            if (!$virhe){
                if (!move_uploaded_file($temp_file,$target_file)) 
                    $virhe = "Kuvan tallennus ei onnistunut.";
                } 
            }
        }
    return [$image,$virhe];
}

if (isset($_POST['nappula'])){
    debuggeri("_POST:");
    debuggeri($_POST);
    [$errors,$values] = validointi($kentat);  
    extract($values);

    if (empty($errors)){
        [$image,$virhe] = hae_kuva($kentat_tiedosto);
        debuggeri("image:$image");

        if ($virhe) $errors['image'] = $virhe;
        elseif (!$image && $current_image) {
            $image = "'$current_image'";
            $kuvatiedosto = PROFIILIKUVAKANSIO . "/" . $current_image;
        }
        elseif ($image) {
            /* Huom. Vanha kuva poistetaan, joten myös 
               current_image saa uuden profiilikuvanimen. */
            poista_vanha_kuva($user_id);
            $kuvatiedosto = PROFIILIKUVAKANSIO."/".$image;
            $current_image = $image;
            $image = "'$image'";
            }
        else {
            /* Huom. image ja current_image ovat tyhjiä. */
            poista_vanha_kuva($user_id);
            $kuvatiedosto = "";
            $image = "NULL";
        }   
    } 
 
    debuggeri(__FILE__.", virheet:");        
    debuggeri($errors);    

    if (empty($errors)) {
        $query = "UPDATE users SET image = $image WHERE id = $user_id";
        debuggeri($query);
        $result = mysqli_my_query($query);
        $muutos = $yhteys->affected_rows;
        debuggeri("muutos:$muutos");


        if ($muutos) {
            $message = "Sähköpostiosoite päivitetty onnistuneesti.";
            $success = "success";
            $display = "d-block";
        } else {
            $message = "Sähköpostin päivitys epäonnistui.";
            $success = "danger";
            $display = "d-block";
        }
        $_SESSION['current_image'] = $current_image;
        $_SESSION['kuvatiedosto'] = $kuvatiedosto;
        header("Location: profiili.php");
        exit;

    }
    else {
        $message = "Tietoja ei muutettu.";
        $success = "danger";
        $display = "d-block";
        $_SESSION['current_image'] = $current_image;
        $_SESSION['kuvatiedosto'] = $kuvatiedosto;
        header("Location: profiili.php");
        exit;
    }
}
 //ob_end_flush();
 
?>