<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';



// Leer el JSON de la solicitud
$data = json_decode(file_get_contents("php://input"));
$id = $data->id ?? null;
$nuevaFecha = $data->nuevaFecha ?? null;

// Validar entrada
if (!$id || !$nuevaFecha) {
    echo json_encode(['success' => false, 'message' => 'ID o nueva fecha no proporcionados']);
    exit;
}

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

$conn->set_charset("utf8");
// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Actualizar la fecha_fin
$sql_update = "UPDATE cubriendo SET fecha_fin = ? WHERE id = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("si", $nuevaFecha, $id);

if ($stmt_update->execute()) {
    echo json_encode(['success' => true, 'nuevaFecha' => $nuevaFecha]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
}

$stmt_update->close();
$conn->close();
?>
