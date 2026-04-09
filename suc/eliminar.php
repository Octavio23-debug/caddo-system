<?php
// Iniciar la sesión
session_start();

// Incluir archivo de configuración para la conexión a la base de datos
include '../includes/config.php';

// Verificar si se ha pasado un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Preparar la consulta para eliminar el registro
    $stmt = $conn->prepare("DELETE FROM sucursal WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirigir a la página principal con un mensaje de éxito
        header("Location: ../sucursales.php?status=success&message=Registro eliminado correctamente");
        exit();
    } else {
        // Redirigir con un mensaje de error si no se pudo eliminar
        header("Location: ../sucursales.php?status=danger&message=Error al eliminar el registro");
        exit();
    }

    $stmt->close();
} else {
    // Redirigir con un mensaje de error si no se pasa un ID válido
    header("Location: ../sucursales.php?status=danger&message=ID inválido");
    exit();
}

// Cerrar la conexión
$conn->close();
?>
