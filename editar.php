<?php
// Conexión a la base de datos
$servername = 'sql105.byethost16.com';
$username = 'b16_38259068';
$password = 'Diego&23';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se pasó el id en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consultar el registro a editar
    $sql = "SELECT * FROM agenda WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Obtener el registro
        $row = $result->fetch_assoc();
        // Aquí puedes mostrar el formulario de edición
        // Por ejemplo, usando los datos obtenidos:
        echo '<form action="guardar_edicion.php" method="POST">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo 'Sucursal: <input type="text" name="sucursal" value="' . $row['sucursal'] . '"><br>';
        echo 'Nombre: <input type="text" name="nombre" value="' . $row['nombre'] . '"><br>';
        echo 'Teléfono: <input type="text" name="telefono" value="' . $row['telefono'] . '"><br>';
        echo 'Teléfono de Emergencia: <input type="text" name="telefono_emergencia" value="' . $row['telefono_emergencia'] . '"><br>';
        echo 'Cargo: <input type="text" name="cargo" value="' . $row['cargo'] . '"><br>';
        echo 'Fecha de Ingreso: <input type="date" name="fecha_ingreso" value="' . $row['fecha_ingreso'] . '"><br>';
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
