<?php
// Iniciar la sesión
session_start();

// Incluir archivo de configuración para la conexión a la base de datos
include 'includes/config.php';

// Verificar si se ha pasado un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Preparar la consulta para actualizar el estado a 'baja' y setear la fecha_fin
    $stmt = $conn->prepare("UPDATE agenda SET estado = 'baja', fecha_fin = NOW() WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();

        // Actualizar el campo 'cajeras' en la tabla 'sucursal'
        $stmtSucursal = $conn->prepare("
            UPDATE sucursal 
            SET cajeras = GREATEST(cajeras - 1, 0) 
            WHERE id = (
                SELECT sucursal FROM agenda WHERE id = ?
            )
        ");
        $stmtSucursal->bind_param("i", $id);
        $stmtSucursal->execute();
        $stmtSucursal->close();

        $_SESSION['message'] = "Registro actualizado a baja correctamente y se restó una cajera.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Error al actualizar el registro.";
        $_SESSION['message_type'] = "danger";
        $stmt->close();
    }
} else {
    // Redirigir con un mensaje de error si no se pasa un ID válido
    $_SESSION['message'] = "ID inválido.";
    $_SESSION['message_type'] = "danger";
}

// Cerrar la conexión
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: tables.php");
exit();
?>