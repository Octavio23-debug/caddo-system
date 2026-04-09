<?php
require 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $nueva_sucursal = $conn->real_escape_string($_POST['sucursal']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $telefono_emergencia = $conn->real_escape_string($_POST['telefono_emergencia']);
    $cargo = $conn->real_escape_string($_POST['cargo']);
    $fecha_ingreso = $conn->real_escape_string($_POST['fecha_ingreso']);

    // Obtener sucursal anterior
    $result = $conn->query("SELECT sucursal FROM agenda WHERE id = $id");
    if ($result && $result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $sucursal_anterior = $fila['sucursal'];

        // Solo actualizar conteos si cambió la sucursal
        if ($sucursal_anterior !== $nueva_sucursal) {
            $conn->query("UPDATE sucursal SET cajeras = cajeras - 1 WHERE nombre = '$sucursal_anterior'");
            $conn->query("UPDATE sucursal SET cajeras = cajeras + 1 WHERE nombre = '$nueva_sucursal'");
        }
    }

    // Actualizar información de la persona
    $sql = "UPDATE agenda 
            SET sucursal = '$nueva_sucursal', 
                nombre = '$nombre', 
                telefono = '$telefono', 
                telefono_emergencia = '$telefono_emergencia', 
                cargo = '$cargo', 
                fecha_ingreso = '$fecha_ingreso' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: tables.php?success=Registro actualizado correctamente");
        exit();
    } else {
        header("Location: tables.php?error=No se pudo actualizar el registro");
        exit();
    }
} else {
    header("Location: tables.php?error=Acceso no permitido");
    exit();
}
?>