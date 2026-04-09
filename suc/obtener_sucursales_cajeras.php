<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida']));
}

$sql = "SELECT id, nombre, direccion, alarma_nuestra, cajeras FROM sucursal WHERE cajeras = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sucursales = [];
    while ($row = $result->fetch_assoc()) {
        $sucursales[] = $row;
    }
    echo json_encode(['success' => true, 'data' => $sucursales]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontraron sucursales con una cajera']);
}

$conn->close();
?>
