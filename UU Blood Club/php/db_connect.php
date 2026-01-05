<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "uubc";
$port = 3377;

$conn = mysqli_connect($servername, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
