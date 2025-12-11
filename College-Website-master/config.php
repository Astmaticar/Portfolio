<?php
$servername = "localhost";
$username = "root"; // kod hostinga ovo bude drugo
$password = "";
$dbname = "portfolio_users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
