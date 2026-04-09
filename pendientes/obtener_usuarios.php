<?php
// Incluir conexión a la base de datos
require '../includes/config.php';

$sql = "SELECT id, nombre FROM usuario"; // Consulta a la tabla usuario
$result = $conn->query($sql);

$usuarios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;  // Almacenar cada usuario en un array
    }
}

echo json_encode($usuarios);  // Devolver la lista de usuarios como JSON
$conn->close();
?>
