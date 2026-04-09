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

// Consultar todas las sucursales
$sql = "SELECT id, nombre FROM sucursal"; // Solo seleccionamos id y nombre
$result = $conn->query($sql);

// Verificar si se encontraron sucursales
if ($result->num_rows > 0) {
    $sucursales = [];
    while ($row = $result->fetch_assoc()) {
        $sucursales[] = $row;  // Añadimos cada sucursal al array
    }
    echo json_encode($sucursales);  // Devolvemos el array de sucursales en formato JSON
} else {
    echo json_encode([]);  // Si no hay sucursales, devolvemos un array vacío
}

$conn->close();
?>
