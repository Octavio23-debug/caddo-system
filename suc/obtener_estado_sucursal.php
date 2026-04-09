<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'b16_38259068_caddo');
$conexion->set_charset("utf8mb4");  // Esto asegura que la codificación sea UTF-8

if ($conexion->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión']);
    exit;
}

// Consulta para obtener todos los estados de las sucursales
$query = "SELECT id, nombre, estado, estado_anterior, updated_at FROM sucursal";
$resultado = $conexion->query($query);

$sucursales = [];
$currentTime = time(); // Tiempo actual en segundos

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $estado = $row['estado'];
        $updatedAt = $row['updated_at'] ? strtotime($row['updated_at']) : null;

        // Determinar si se actualizó a "Normal" en las últimas 24 horas
        $updatedRecently = $updatedAt && ($currentTime - $updatedAt) <= 24 * 60 * 60;

        // Solo incluimos las sucursales que tienen el estado "Normal" y se han actualizado en las últimas 24 horas
        if ($estado === 'Normal' && $updatedRecently) {
            $sucursales[] = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'estado' => $estado,
                'estado_anterior' => $row['estado_anterior'],
                'updated_at' => $row['updated_at'],
                'updated_recently' => true // Solo marcamos 'true' si se actualizó recientemente
            ];
        } 
        // Si el estado no es "Normal", mostramos las sucursales sin considerar la fecha
        elseif ($estado !== 'Normal') {
            $sucursales[] = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'estado' => $estado,
                'estado_anterior' => $row['estado_anterior'],
                'updated_at' => $row['updated_at'],
                'updated_recently' => false // No nos importa el tiempo de actualización
            ];
        }
    }

    echo json_encode(['success' => true, 'sucursales' => $sucursales]);
} else {
    echo json_encode(['success' => false, 'message' => 'No se encontraron sucursales']);
}

$conexion->close();
?>
