<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../includes/config.php';

$data = json_decode(file_get_contents("php://input"), true);

$id_user = $data['id_usuario'] ?? null;
$folio   = $data['folio'] ?? null;
$monto   = $data['monto'] ?? 20; // Siempre 20 si no viene
$fecha   = $data['fecha'] ?? null;
$fondo   = $data['fondo'] ?? null;
$factura = $data['factura'] ?? 'No';

if (!$id_user || !$folio || !$fecha) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    exit;
}

// Obtener todas las sucursales
$sql = "SELECT id FROM sucursal";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $stmt = $conn->prepare("INSERT INTO recargas (folio, monto, factura, id_suc, id_user, fecha, fondo) VALUES (?, ?, ?, ?, ?, ?, ?)");

    while ($row = $result->fetch_assoc()) {
        $id_suc = $row['id'];
        $stmt->bind_param('sdsiiss', $folio, $monto, $factura, $id_suc, $id_user, $fecha, $fondo);
        $stmt->execute();
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'No hay sucursales registradas']);
}
?>
