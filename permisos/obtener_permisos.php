<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'b16_38259068_caddo'; // Cambia por tu base de datos

$conexion = new mysqli($host, $user, $password, $database);
$conexion->set_charset("utf8mb4");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

// Consulta para obtener los permisos y nombre de la sucursal
$query = "
    SELECT p.id, p.permiso, s.nombre AS sucursal_nombre
    FROM permisos p
    LEFT JOIN sucursal s ON p.suc_id = s.id
    ORDER BY p.id DESC
";

$result = $conexion->query($query);

$permisos = [];
while ($row = $result->fetch_assoc()) {
    $permisos[] = $row;
}

echo json_encode($permisos);
?>
