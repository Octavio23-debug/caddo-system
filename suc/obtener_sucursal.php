<?php
include '../includes/config.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Conexión fallida']));
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Consultar el registro
    $sql = "SELECT * FROM sucursal WHERE id = $id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        echo json_encode([
            'success' => true,
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'direccion' => $row['direccion'],
            'alarma_nuestra' => $row['alarma_nuestra'],
            'cajeras' => $row['cajeras'],
            'id_zona' => $row['id_zona'] // ✅ ¡Este es el nuevo campo!
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registro no encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
}

$conn->close();
?>