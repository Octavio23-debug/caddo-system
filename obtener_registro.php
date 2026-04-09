<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida']));
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar el registro
    $sql = "SELECT * FROM agenda WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'id' => $row['id'], 'sucursal' => $row['sucursal'], 'nombre' => $row['nombre'], 'telefono' => $row['telefono'], 'telefono_emergencia' => $row['telefono_emergencia'], 'cargo' => $row['cargo'], 'fecha_ingreso' => $row['fecha_ingreso']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registro no encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
}

$conn->close();
?>
