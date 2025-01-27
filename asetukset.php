<?php
error_reporting(E_ALL);
$PALVELIN = $_SERVER['HTTP_HOST']."/";
$LINKKI_RESETPASSWORD = "resetpassword.php";
$LINKKI_VERIFICATION = "verification.php";
$PALVELUOSOITE = "asiakaspalvelu@sarjakuvat.fi";

define("OLETUSSIVU","profiili.php");
define("SARJAKUVAKUVAKANSIO","sarjakuvien_kuvat");
define("SARJAKUVAKUVAKOKO",1048576);
define("PROFIILIKUVAKANSIO","profiili_kuvat");
define("PROFIILIKUVAKOKO",1048576);
define("EMAIL_FROM","wohjelmointi@gmail.com");
define("EMAIL_FROM_NAME","Ohjelmointikurssi");

//HOST PASS USER MYSQL_...

$DB = "sarjakuva_seuranta";

$LOCAL = in_array($_SERVER['REMOTE_ADDR'],array('127.0.0.1','REMOTE_ADDR' => '::1'));
if ($LOCAL) {	
    $tunnukset = "../../tunnukset.php";
    if (file_exists($tunnukset)){
        include_once("../../tunnukset.php");
        } 
    else {
        die("Tiedostoa ei löydy, ota yhteys ylläpitoon.");
        } 
        
    $PALVELU = "SarjakuvaSeuranta/";
    $db_server = $db_server_local;
    $db_username = $db_username_local; 
    $db_password = $db_password_local;
    $EMAIL_ADMIN = $admin_mail;
    $marvel_APIKEYPUBLIC = $marvel_APIKEYPUBLIC_local;
    $marvel_APIKEY = $marvel_APIKEY_local;
    $port = "3306";
    }
elseif (strpos($_SERVER['HTTP_HOST'],"azurewebsites") !== false){
    define("DEBUG",false);
    
    $PALVELU = "";
    $db_server = $_ENV['MYSQL_HOSTNAME'] ?? getenv('MYSQL_HOSTNAME');
    $db_username = $_ENV['MYSQL_USERNAME'] ?? getenv('MYSQL_USERNAME');
    $db_password = $_ENV['MYSQL_PASSWORD'] ?? getenv('MYSQL_PASSWORD');
    $marvel_APIKEYPUBLIC = $_ENV['MYSQL_APIKEYPUBLIC'] ?? getenv('MYSQL_APIKEYPUBLIC');
    $marvel_APIKEY = $_ENV['MYSQL_APIKEY'] ?? getenv('MYSQL_APIKEY');
    $port = $_ENV['MYSQL_PORT'] ?? getenv('MYSQL_PORT');
    /* Mailtrap */
    $EMAIL_ADMIN = $_ENV['EMAIL_ADMIN'] ?? getenv('EMAIL_ADMIN'); 
    $username_mailtrap = $_ENV['EMAIL_USERNAME'] ?? getenv('EMAIL_USERNAME');
    $password_mailtrap = $_ENV['EMAIL_PASSWORD'] ?? getenv('EMAIL_PASSWORD');
    }

define("SAHKOPOSTIPALVELU","mailtrap");
if (SAHKOPOSTIPALVELU == 'sendgrid'){
    /* SendGrid */      
    define("EMAIL_HOST","smtp.sendgrid.net");
    define("EMAIL_PORT", 587);
    define("EMAIL_USERNAME",$username_sendgrid);
    define("EMAIL_PASSWORD",$password_sendgrid);
    }
    
elseif (SAHKOPOSTIPALVELU == 'mailtrap'){
    /* Mailtrap */
    define("EMAIL_HOST",'smtp.mailtrap.io');
    define("EMAIL_PORT",2525);
    define("EMAIL_USERNAME",$username_mailtrap);
    define("EMAIL_PASSWORD",$password_mailtrap);
    //debuggeri("username:".USERNAME.",password:".PASSWORD);
    }

?>