<?php
// Incluir la conexión a la base de datos
require '../includes/config.php';

// Obtener los datos del cuerpo de la solicitud en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si los datos necesarios están presentes
if (isset($data['id_sucursal'], $data['folio'], $data['factura'], $data['fecha'], $data['id_usuario'])) {
    // Obtener los valores de la solicitud
    $id_sucursal = (int) $data['id_sucursal'];  // Asegurarse de que el ID de sucursal es un entero
    $folio = $conn->real_escape_string($data['folio']);  // Escapar el folio
    $factura = 'No';  // Asigna 'No' al campo factura por defecto
    $fecha = $conn->real_escape_string($data['fecha']);  // Escapar la fecha
    $id_usuario = (int) $data['id_usuario'];  // Asegurarse de que el ID de usuario es un entero

    // Establecer el valor predefinido para "monto"
    $monto = 20.00;  // Puedes reemplazar este valor con el monto predefinido que desees

    // Verificar que el id_sucursal y id_usuario son números positivos válidos
    if ($id_sucursal > 0 && $id_usuario > 0) {
        // Consulta SQL para insertar los datos en la tabla recargas
        $sql = "INSERT INTO recargas (id_suc, folio, monto, factura, fecha, id_user)  
                VALUES ($id_sucursal, '$folio', '$monto', '$factura', '$fecha', $id_usuario)";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);  // Respuesta exitosa
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar el pendiente', 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de sucursal o usuario no válidos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan datos necesarios']);
}

$conn->close();
?>