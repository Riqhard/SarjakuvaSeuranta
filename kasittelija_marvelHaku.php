<?php
// Your Marvel API credentials
$publicKey = '';
$privateKey = '';
$ts = time();  // Get current timestamp

$privateKey = $marvel_APIKEY;
$publicKey = $marvel_APIKEYPUBLIC;

$localurl = "http://localhost/sarjakuvaseuranta/.env";
// Create the hash
$hash = md5($ts . $privateKey . $publicKey);

// API endpoint
$url = "http://gateway.marvel.com/v1/public/comics";

// Check if search term is set
$searchTerm = isset($_GET['haku']) ? $_GET['haku'] : '';
// Check if limit is set
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;

// Parameters for the request
$params = [
    'apikey' => $publicKey,
    'ts' => $ts,
    'hash' => $hash,
    'limit' => $limit  // Use the limit set by the user
];

// Add titleStartsWith parameter only if search term is not empty
if (!empty($searchTerm)) {
    $params['titleStartsWith'] = $searchTerm;
}

// Build the query string
$queryString = http_build_query($params);

// Complete URL with query string
$requestUrl = $url . '?' . $queryString;
?>

<div id="sailio">

    <div class="uutis_otsikko">
        Marvel sarjakuvat
    </div>

    <div id="sisalto">
    <form method="GET" action="">
    <fieldset>
    <div class="sisalto_otsikko">Haun rajaus</div>
        <div class="hakukentta">
        <input type="text" name="haku" placeholder="Hae sarjakuvia" value="<?php echo htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <input type="number" name="limit" placeholder="Hakutulosten määrä" value="<?php echo htmlspecialchars($limit, ENT_QUOTES, 'UTF-8'); ?>"><br>
        <input class="hakunappula" type="submit" name="nappula" value="Hae">
        </div>
    </fieldset>
    </form>
    </div>

<br>

    <div id="sisalto">

    <div class="uutis_otsikko">
        Haku tulokset
    </div>
<?php
if (isset($_GET['nappula'])){
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
    echo '<div class="tulokset">';
    if (isset($data['data']['results'])) {
        $index = 0;
        foreach ($data['data']['results'] as $comic) {
            $class = ($index % 2 == 0) ? 'even' : 'odd';
            echo "<div class='$class'>" . htmlspecialchars($comic['title'], ENT_QUOTES, 'UTF-8') . "</div>";
            $index++;
        }
    } else {
        echo "<div>No comics found!</div>";
    }
    echo '</div>';
}
?>

    </div>  
</div>
