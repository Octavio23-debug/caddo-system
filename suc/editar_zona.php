<?php
include '../includes/config.php';
$data = json_decode(file_get_contents("php://input"), true);

$conn->query("UPDATE zona SET 
nombre='{$data['nombre']}', 
encargada_o='{$data['encargada_o']}'
WHERE id='{$data['id_zona']}'");
