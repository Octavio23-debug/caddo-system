<?php
include 'includes/config.php'; // Incluye la configuración de la BD

// Verificar si se recibió un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta con JOIN para obtener los datos de la cajera y el nombre de la sucursal
    $sql = "SELECT a.id, s.nombre AS nombre_sucursal, a.nombre, a.telefono, 
                   a.telefono_emergencia, a.cargo, a.fecha_ingreso 
            FROM agenda a
            LEFT JOIN sucursal s ON a.sucursal = s.id
            WHERE a.id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'id' => $row['id'],
            'sucursal' => $row['nombre_sucursal'], // Devuelve el nombre de la sucursal en lugar del ID
            'nombre' => $row['nombre'],
            'telefono' => $row['telefono'],
            'telefono_emergencia' => $row['telefono_emergencia'],
            'cargo' => $row['cargo'],
            'fecha_ingreso' => $row['fecha_ingreso']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registro no encontrado']);
    }
} else {
    // Si no se envió un ID, obtener todas las sucursales activas excluyendo id 190
    $sql = "SELECT a.id, s.nombre AS nombre_sucursal
            FROM agenda a
            LEFT JOIN sucursal s ON a.sucursal = s.id
            WHERE a.sucursal <> 190
            ORDER BY s.nombre ASC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $sucursales = [];
        while ($row = $result->fetch_assoc()) {
            $sucursales[] = $row;
        }
        echo json_encode(['success' => true, 'data' => $sucursales]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron registros']);
    }
}

$conn->close();
?>