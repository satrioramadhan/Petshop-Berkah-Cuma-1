<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "petshopp"; 
$port = 3307; 


$conn = new mysqli($servername, $username, $password, $dbname, $port);


if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
?>
