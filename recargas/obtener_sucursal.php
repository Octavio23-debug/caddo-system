<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida']));
}

// Consultar todas las sucursales excluyendo el id 190 y ordenando por nombre
$sql = "SELECT id, nombre FROM sucursal WHERE id <> 190 ORDER BY nombre ASC";
$result = $conn->query($sql);

// Verificar si se encontraron sucursales
if ($result->num_rows > 0) {
    $sucursales = [];
    while ($row = $result->fetch_assoc()) {
        $sucursales[] = $row;
    }
    echo json_encode($sucursales);
} else {
    echo json_encode([]);
}

$conn->close();
?>
