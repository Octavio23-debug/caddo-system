<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida']));
}

// Obtener los datos del POST
$data = json_decode(file_get_contents('php://input'), true);
$idSucursal = $conn->real_escape_string($data['id_sucursal']);
$motivo = $conn->real_escape_string($data['motivo']);
$fechaInicio = $conn->real_escape_string($data['fecha_inicio']);
$fechaFin = $conn->real_escape_string($data['fecha_fin']);
$idCajera = $conn->real_escape_string($data['id_cajera'] ?? ''); // Puede ser NULL si no se envía

// Si idCajera está vacío o no enviado, guardamos NULL
$idCajeraValue = ($idCajera === '') ? "NULL" : "'$idCajera'";

// Insertar en la tabla cubriendo incluyendo id_c
$sql = "INSERT INTO cubriendo (id_s, motivo, fecha_inicio, fecha_fin, id_c) 
        VALUES ('$idSucursal', '$motivo', '$fechaInicio', '$fechaFin', $idCajeraValue)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['success' => true, 'message' => 'Datos guardados correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar los datos: ' . $conn->error]);
}

$conn->close();
?>
