<?php
require_once 'includes/config.php';

if (isset($_POST['id']) && isset($_POST['telefono'])) {

    $id = intval($_POST['id']);
    $telefono = $conn->real_escape_string($_POST['telefono']);

    $sql = "UPDATE sucursal 
            SET telefono_policia = '$telefono' 
            WHERE id = $id";

    if ($conn->query($sql)) {
        echo "ok";
    } else {
        echo "Error al guardar";
    }

} else {
    echo "Datos incompletos";
}

$conn->close();
?>