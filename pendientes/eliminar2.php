<?php
// Iniciar la sesión
session_start();

// Incluir archivo de configuración para la conexión a la base de datos
include '../includes/config.php';

// Verificar si se ha pasado un ID por POST
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);  // Asegurarse de que el ID sea un número entero

    // Preparar la consulta para actualizar el estado del pendiente
    $stmt = $conn->prepare("UPDATE pendientes SET estado = 'Listo' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Si la actualización fue exitosa, enviar respuesta 'success'
        echo 'success';
        exit();
    } else {
        // Si no se pudo actualizar, enviar respuesta 'error'
        echo 'error';
        exit();
    }

    $stmt->close();
} else {
    // Si no se pasa un ID válido, enviar respuesta 'invalid_id'
    echo 'invalid_id';
    exit();
}

// Cerrar la conexión
$conn->close();
?>
