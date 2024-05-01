<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "kabarkadogs";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>