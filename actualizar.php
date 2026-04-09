<?php
// Iniciar la sesión
session_start();

// Incluir archivo de configuración para la conexión a la base de datos
include 'includes/config.php';

// Verificar si se ha pasado un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Preparar la consulta para actualizar el cargo a 'cajera' solo para el ID especificado
    $stmt = $conn->prepare("UPDATE agenda SET cargo = 'CAJERA' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registro actualizado a cajera correctamente.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error al actualizar el registro: " . $stmt->error;
        $_SESSION['message_type'] = "danger";
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "ID inválido.";
    $_SESSION['message_type'] = "danger";
}

// Cerrar la conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: tables.php");
exit();
?>