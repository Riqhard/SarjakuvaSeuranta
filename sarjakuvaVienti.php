<?php
include "asetukset.php";
include "db.php";
include "rememberme.php";

$loggedIn = secure_page();
$title = 'Haku';
include "header.php"; 

// Path to your JSON file
$jsonFile = 'comics.json';

// Read JSON file
$jsonData = file_get_contents($jsonFile);

// Decode JSON data into PHP array
$comics = json_decode($jsonData, true);

// Prepare and bind statement to prevent SQL injection
$stmt = $yhteys->prepare("INSERT INTO sarjakuvat (title, description, pageCount, creators, images) VALUES (?, ?, ?, ?, ?)");

// Check if preparation is successful
if ($stmt === false) {
    die("Failed to prepare statement: " . $yhteys->error);
}

// Bind parameters
$stmt->bind_param("ssiss", $title, $description, $pageCount, $creators, $images);

// Loop through each comic and insert data into the database
foreach ($comics['comics'] as $comic) {
    $title = $comic['title'];
    $description = $comic['description'];
    $pageCount = $comic['pageCount'];
    // Convert creators and images array to comma-separated string
    $creators = implode(", ", $comic['creators']);
    $images = implode(", ", $comic['images']);
    
    // Execute the insert statement
    $stmt->execute();
}

// Close statement and connection
$stmt->close();

echo "Data inserted successfully!";
?>