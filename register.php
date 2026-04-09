<?php
include 'includes/config.php';
include 'includes/functions.php';

$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($nombre) || empty($username) || empty($password)) {
        $error = 'Por favor, completa todos los campos.';
    } else {
        if (registerUser($conn, $nombre, $username, $password)) {
            $success = 'Usuario registrado exitosamente. Ahora puedes iniciar sesión.';
        } else {
            $error = 'Error al registrar el usuario. El nombre de usuario ya existe.';
        }
    }
}

// Incluir el HTML del formulario de registro
include 'templates/register_form.php';
?>
