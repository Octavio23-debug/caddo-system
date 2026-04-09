<?php
// Incluir archivo de configuración
include '../includes/config.php';

// Verifica si se pasó el ID
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta SQL para eliminar el registro
    $sql = "DELETE FROM cubriendo WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro eliminado";
    } else {
        echo "Error al eliminar el registro";
    }

    $stmt->close();
}

// Cierra la conexión (puede omitirse si se maneja globalmente)
$conn->close();
?>