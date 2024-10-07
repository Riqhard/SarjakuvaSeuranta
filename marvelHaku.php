<?php
// Your Marvel API credentials
$publicKey = '';
$privateKey = '';
$ts = time();  // Get current timestamp


require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$privateKey = $_ENV['APIKEY'];
$publicKey = $_ENV['APIKEYPUBLIC'];
$password = $_ENV['SPSALASANA'];

$localurl = "http://localhost/sarjakuvaseuranta/.env";
// Create the hash
$hash = md5($ts . $privateKey . $publicKey);

// API endpoint
$url = "http://gateway.marvel.com/v1/public/comics";

// Parameters for the request
$params = [
    'apikey' => $publicKey,
    'ts' => $ts,
    'hash' => $hash,
    'limit' => 20  // You can set the limit to control how many comics are retrieved
];

// Build the query string
$queryString = http_build_query($params);

// Complete URL with query string
$requestUrl = $url . '?' . $queryString;

// Use cURL to make the GET request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $requestUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    die("cURL Error: $error");
}

curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Check for JSON errors
if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON Error: " . json_last_error_msg());
}

// Check if the response contains comics data
if (isset($data['data']['results'])) {
    foreach ($data['data']['results'] as $comic) {
        echo "Title: " . htmlspecialchars($comic['title'], ENT_QUOTES, 'UTF-8') . "<br>";
    }
} else {
    echo "No comics found!";
}
?>