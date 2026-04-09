<?php
include '../includes/config.php'; // Ajusta según tu configuración

$query = "SELECT * FROM pendientes WHERE asignado_a = :usuario_id"; // Ajusta tu consulta
$stmt = $conn->prepare($query);
$stmt->execute(['usuario_id' => $_SESSION['usuario_id']]);
$pendientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($pendientes);
?>
