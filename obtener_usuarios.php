<?php
require_once 'includes/config.php';

header('Content-Type: application/json');

$usuarioActual = $_GET['actual'] ?? '';

// 🔥 Usuarios a excluir
$excluir = ['Todos', 'Soporte Técnico', 'prueba1234', $usuarioActual];

// 🔹 Preparar placeholders dinámicos (?, ?, ?, ?)
$placeholders = implode(',', array_fill(0, count($excluir), '?'));

$sql = "SELECT id, nombre 
        FROM usuario 
        WHERE nombre NOT IN ($placeholders)";

$stmt = $conn->prepare($sql);

// 🔹 Tipos (todos string)
$types = str_repeat('s', count($excluir));
$stmt->bind_param($types, ...$excluir);

$stmt->execute();
$resultado = $stmt->get_result();

$usuarios = [];

while ($row = $resultado->fetch_assoc()) {
    $usuarios[] = $row;
}

echo json_encode($usuarios);