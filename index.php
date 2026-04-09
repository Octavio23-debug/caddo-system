<?php
session_start();
include 'includes/config.php';
include 'includes/functions.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Por favor, completa todos los campos.';
    } else {
        $stmt = $conn->prepare("SELECT id, nombre, nom_corto, password FROM usuario WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Regenerar ID de sesión para evitar secuestro
                session_regenerate_id(true);

                // Almacenar datos del usuario en la sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['nom_corto'] = $user['nom_corto']; // 👈 Esta línea


                // Redirigir al dashboard
                header('Location: index2.php');
                exit;
            } else {
                $error = 'Usuario o contraseña incorrectos.';
            }
        } else {
            $error = 'Usuario o contraseña incorrectos.';
        }
    }
}
include 'templates/login_form.php';
?>
