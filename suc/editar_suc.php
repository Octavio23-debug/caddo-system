<?php
// Conexión a la base de datos
$servername = 'localhost';
$username = 'root0';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se pasó el id en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consultar el registro a editar
    $sql = "SELECT * FROM sucursal WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Obtener el registro
        $row = $result->fetch_assoc();
        // Aquí puedes mostrar el formulario de edición
        // Por ejemplo, usando los datos obtenidos:
        echo '<form action="suc/guardar_edicion_suc.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo 'Nombre: <input type="text" name="nombre" value="' . $row['nombre'] . '"><br>';
        echo 'Direccion: <input type="text" name="direccion" value="' . $row['direccion'] . '"><br>';
        echo 'Alarma nuestra: <input type="text" name="alarma_nuestra" value="' . $row['alarma_nuestra'] . '"><br>';
        echo 'Cajeras: <input type="text" name="cajeras" value="' . $row['cajeras'] . '"><br>';
        echo '<button type="submit">Guardar Cambios</button>';
        echo '</form>';
    } else {
        echo "Registro no encontrado";
    }
} else {
    echo "No se proporcionó un id";
}

$conn->close();
?>

