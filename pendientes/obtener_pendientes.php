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

    // Consultar el registro con JOIN entre 'pendientes' y 'sucursal'
    $sql = "SELECT p.id, p.nombre, p.pendiente, p.fecha, s.nombre AS sucursal_nombre
            FROM pendientes p
            LEFT JOIN sucursal s ON p.id_sucursal = s.id
            WHERE p.id = $id";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'success' => true, 
            'id' => $row['id'],
            'sucursal_nombre' => $row['sucursal_nombre'],
            'pendiente' => $row['pendiente'], 
            'fecha' => $row['fecha']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Registro no encontrado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
}

$conn->close();

?>
