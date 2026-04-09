<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'b16_38259068_caddo';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibieron los datos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['id']);
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $direccion = $conn->real_escape_string($_POST['direccion']);
    $alarma_nuestra = $conn->real_escape_string($_POST['alarma_nuestra']);
    $cajeras = $conn->real_escape_string($_POST['cajeras']);
    $id_zona = isset($_POST['id_zona']) ? intval($_POST['id_zona']) : null;

    // Validar zona seleccionada
    if (!$id_zona) {
        header("Location: ../sucursales.php?error=Zona no seleccionada");
        exit();
    }

    // Actualizar el registro en la base de datos incluyendo id_zona
    $sql = "UPDATE sucursal 
            SET  
                nombre = '$nombre', 
                direccion = '$direccion', 
                alarma_nuestra = '$alarma_nuestra', 
                cajeras = '$cajeras',
                id_zona = $id_zona
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../sucursales.php?success=Registro actualizado correctamente");
        exit();
    } else {
        header("Location: ../sucursales.php?error=No se pudo actualizar el registro");
        exit();
    }
} else {
    header("Location: ../sucursales.php?error=Acceso no permitido");
    exit();
}

$conn->close();
?>