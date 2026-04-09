<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']));
}

// Leer los datos enviados
$data = json_decode(file_get_contents('php://input'), true);

// Validar los campos
$campos_faltantes = [];
foreach (['nombre', 'direccion', 'alarma_nuestra', 'cajeras', 'id_zona'] as $campo) {
    if (empty($data[$campo])) {
        $campos_faltantes[] = $campo;
    }
}

if (empty($campos_faltantes)) {
    $nombre = $conn->real_escape_string($data['nombre']);
    $direccion = $conn->real_escape_string($data['direccion']);
    $alarma_nuestra = $conn->real_escape_string($data['alarma_nuestra']);
    $cajeras = $conn->real_escape_string($data['cajeras']);
    $id_zona = intval($data['id_zona']);

    $sql = "INSERT INTO sucursal (nombre, direccion, alarma_nuestra, cajeras, id_zona) 
            VALUES ('$nombre', '$direccion', '$alarma_nuestra', '$cajeras', $id_zona)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar los datos']);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Faltan datos en: ' . implode(', ', $campos_faltantes)
    ]);
}

$conn->close();
?>