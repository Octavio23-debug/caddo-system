<?php
// suc/obtener_sucursal.php

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "b16_38259068_caddo");
$conexion->set_charset("utf8mb4");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Consulta para obtener las sucursales
$sql = "SELECT id, nombre FROM sucursal";  // Asegúrate de que este sea el nombre correcto de la tabla
$result = $conexion->query($sql);

// Verifica si la consulta tiene resultados
if ($result->num_rows > 0) {
    $sucursales = [];
    while($row = $result->fetch_assoc()) {
        // Agregar cada sucursal a un array
        $sucursales[] = $row;
    }
    // Devolver los datos en formato JSON
    echo json_encode(['sucursales' => $sucursales]);
} else {
    // Si no hay sucursales, devolver un array vacío
    echo json_encode(['sucursales' => []]);
}

$conexion->close();
?>
