<?php
include '../includes/config.php';
$data = json_decode(file_get_contents("php://input"), true);

$conn->query("INSERT INTO zona (nombre, encargada_o)
VALUES ('{$data['nombre']}', '{$data['encargada_o']}')");
