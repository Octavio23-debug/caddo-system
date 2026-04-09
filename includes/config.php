<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");  // Esto asegura que la codificación sea UTF-8

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
?>
