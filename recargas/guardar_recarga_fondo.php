<?php
// Incluir la conexión a la base de datos
require '../includes/config.php';

// Obtener los datos del cuerpo de la solicitud en formato JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que los datos necesarios están presentes
if (isset($data['id_suc'], $data['fecha'], $data['monto'], $data['factura'], $data['id_user'], $data['folio'], $data['fondo'])) {
    // Obtener los valores de la solicitud
    $id_suc = (int) $data['id_suc'];  // Asegurarse de que el ID de sucursal es un entero
    $fecha = $conn->real_escape_string($data['fecha']);  // Escapar la fecha
    $monto = (float) $data['monto'];  // Asegurarse de que el monto es un número válido
    $factura = $conn->real_escape_string($data['factura']);  // Escapar factura
    $id_user = (int) $data['id_user'];  // Asegurarse de que el ID de usuario es un entero
    $folio = $conn->real_escape_string($data['folio']);  // Escapar el folio
    $fondo = (float) $data['fondo'];  // Convertir fondo a número

    // Consulta SQL para insertar los datos en la tabla recargas
    $sql = "INSERT INTO recargas (id_suc, fecha, monto, factura, id_user, folio, fondo) 
            VALUES ($id_suc, '$fecha', $monto, '$factura', $id_user, '$folio', $fondo)";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);  // Respuesta exitosa
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al guardar el fondo', 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan datos necesarios']);
}

$conn->close();
?>
