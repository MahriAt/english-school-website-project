<?php
$username = "if0_39121519";
$password = "kiral232";
$database = "if0_39121519_english_school"; 
$servername = "sql313.infinityfree.com";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>