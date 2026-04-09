<?php
include 'includes/config.php'; // Incluye el archivo de configuración

// Recibir datos del formulario
$sucursal = $_POST['sucursal'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$telefono_emergencia = $_POST['telefono_emergencia'];
$cargo = $_POST['cargo'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$estado = "alta"; // Valor predeterminado

// Insertar en la base de datos
$sql = "INSERT INTO agenda (sucursal, nombre, telefono, telefono_emergencia, cargo, fecha_ingreso, estado) 
        VALUES ('$sucursal', '$nombre', '$telefono', '$telefono_emergencia', '$cargo', '$fecha_ingreso', '$estado')";

if ($conn->query($sql) === TRUE) {
    // Actualizar el conteo de cajeras en la sucursal (sumar 1)
    $updateSucursal = "UPDATE sucursal SET cajeras = cajeras + 1 WHERE id = '$sucursal'";
    $conn->query($updateSucursal); // Puedes validar este resultado también si lo deseas

    echo json_encode(["success" => true, "message" => "Cajera agregada correctamente y contador actualizado"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
}

$conn->close();
?>