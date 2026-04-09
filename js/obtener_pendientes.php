<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'b16_38259068_caddo'; // Nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar el conjunto de caracteres a UTF-8
$conexion->set_charset("utf8");

// Asumiendo que ya tienes una conexión a la base de datos establecida
header('Content-Type: application/json');

$query = "
    SELECT p.id, p.pendiente, p.fecha, s.nombre AS sucursal_nombre
    FROM pendientes p
    LEFT JOIN sucursal s ON p.id_sucursal = s.id
    WHERE DATE(p.fecha) = CURDATE() AND p.estado = 'En proceso'
    ORDER BY p.fecha DESC;
";

$result = $conexion->query($query);

$pendientes = [];
while ($row = $result->fetch_assoc()) {
    $pendientes[] = $row;
}

echo json_encode($pendientes);

?>
