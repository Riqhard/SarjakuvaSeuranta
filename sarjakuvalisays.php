<?php
$display = "d-none";
$message = "";
$success = "";
$lisays = $lisattiin_token = $lahetetty = false;


function hae_kuva($kentta){   
    /* Huom. foreach-silmukka on tässä malliksi, ei valmis.
       Nimen tarkistukseen ei ole tässä koodia. */
        $kentat_tiedosto = $GLOBALS['kentat_tiedosto'];   
        $allowed_images = $GLOBALS['allowed_images'];
        $virhe = false;   
        $image = "";
        foreach ($kentat_tiedosto as $kentta){
        if (!isset($_FILES[$kentta])) continue;    
        if (is_uploaded_file($_FILES[$kentta]['tmp_name'])) {
           $random = randomString(3);
           $maxsize = SARJAKUVAKUVAKOKO;
           $temp_file = $_FILES[$kentta]["tmp_name"];       
           $filesize = $_FILES[$kentta]['size'];
           $pathinfo = pathinfo($_FILES[$kentta]["name"]);
           $filetype = strtolower($pathinfo['extension']);
           $image = $pathinfo['filename']."_$random.$filetype";
           $target_dir = SARJAKUVAKUVAKANSIO;
           $target_file = "$target_dir/$image";
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
    [$errors,$values] = validointi($kentat);  
    extract($values);

    if (empty($errors)){
        [$image,$virhe] = hae_kuva($kentat_tiedosto);
        if ($virhe) $errors['image'] = $virhe;
        $image = ($image) ? "'$image'" : "NULL";
        }   

        debuggeri($errors);    
        if (empty($errors)) {
            // echo "$title : $description : $image : $chapters";
            $query = "INSERT INTO sarjakuvat (title, description, image, chapters) VALUES ('$title', '$description', $image, '$chapters')";
            debuggeri($query);
            $result = mysqli_my_query($query);
            $lisays = $yhteys->affected_rows;
            debuggeri("lisays:$lisays");
            $message = "Sarjakuva lisätty";
            $success = "success";
            $display = "d-block";
        }
        else {
            $message = "Sarjakuva lisäys epäonnistui!";
            $success = "danger";
            }

}  
        
?>