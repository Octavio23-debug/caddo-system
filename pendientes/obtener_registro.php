<?php
include '../includes/config.php';

// Verificar que el parámetro 'id' esté presente
if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => 'El ID es obligatorio.']);
    exit;
}

$id = $_POST['id'];

// Verificar la conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

// Consultar el registro
$sql_registro = "SELECT p.id, p.pendiente, p.fecha, p.usuario_id, s.nombre AS sucursal_nombre 
                 FROM pendientes p
                 JOIN sucursal s ON p.id_sucursal = s.id
                 WHERE p.id = ?";
$stmt = $conn->prepare($sql_registro);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta del registro.']);
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result_registro = $stmt->get_result();

// Verificar si el registro existe
if ($result_registro->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Registro no encontrado.']);
    exit;
}

$registro = $result_registro->fetch_assoc();
$stmt->close();

// Consultar todos los usuarios
$sql_usuarios = "SELECT id, nombre FROM usuario";
$result_usuarios = $conn->query($sql_usuarios);

// Verificar si hay usuarios
if ($result_usuarios->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'No se encontraron usuarios.']);
    exit;
}

$usuarios = [];
while ($row = $result_usuarios->fetch_assoc()) {
    $usuarios[] = $row;
}

// Devolver los datos como JSON
echo json_encode(['success' => true, 'registro' => $registro, 'usuarios' => $usuarios]);

$conn->close();
?>
