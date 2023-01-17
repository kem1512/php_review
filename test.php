<?php
$servername = "localhost";
$username = "fguuuzgkhosting_root";
$password = "padaoks1512";
$dbname = "fguuuzgkhosting_php_laravel";
$port = "3306";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>