<?php
/* ALOITUS */   
$user_id = $_SESSION['user_id'] ?? 0;
$display = $_SESSION["display"] ?? "d-none";
$message = $_SESSION["message"] ?? "";
$success = $_SESSION["success"] ?? "success";
$kuvatiedosto = $_SESSION['kuvatiedosto'] ?? "";
$current_image = $_SESSION['current_image'] ?? "";

if ($user_id) {
    $query = "SELECT image FROM users WHERE id = ?";
    debuggeri($query);
    $stmt = $yhteys->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($image_name);
    $stmt->fetch();
    $stmt->close();
    if ($image_name) {
        $image_path = PROFIILIKUVAKANSIO . "/" . $image_name;
        if (!file_exists($image_path)) {
            $current_image = "";
            $kuvatiedosto = "";
        } else {
            $current_image = $image_path;
        }

    } else {
        $current_image = "";
        $kuvatiedosto = "";
    }


}
 ?>