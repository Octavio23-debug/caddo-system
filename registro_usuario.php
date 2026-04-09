<?php
// Configuración de la conexión a la base de datos
$host = 'sql105.byethost16.com';
$user = 'b16_38259068';
$password = 'Diego&23';
$database = 'b16_38259068_caddo';// Nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres
$conexion->set_charset("utf8");

// Validar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validar campos vacíos
    if (empty($nombre) || empty($email) || empty($password)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Validar formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingresa un correo electrónico válido.";
        exit;
    }

    // Validar si el email ya está registrado
    $stmt = $conexion->prepare("SELECT id FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
        exit;
    }
    $stmt->close();

    // Hashear la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar los datos en la tabla `usuario`
    $stmt = $conexion->prepare("INSERT INTO usuario (id, nombre, username, password) VALUES (?, ?, ?, ?");
    $stmt->bind_param("sss",$id, $nombre, $username, $password_hash);

    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
}

// Cerrar conexión
$conexion->close();
?>
