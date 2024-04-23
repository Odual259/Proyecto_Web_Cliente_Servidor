<?php
$servername = "localhost";
$username = "root";
$password = "root123";
$database = "proyecto_kdn";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
