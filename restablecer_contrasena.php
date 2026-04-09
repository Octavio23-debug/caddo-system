<?php
session_start();
include 'includes/config.php';

// Mostrar errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar que hay un usuario en sesión
if (!isset($_SESSION['usuario_recuperacion'])) {
    die("Error: No se ha recibido la sesión del usuario. Vuelve a intentarlo.");
}

$usuario = $_SESSION['usuario_recuperacion']; // Usuario recuperado

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nueva_password = trim($_POST['nueva_password']);
    $confirmar_password = trim($_POST['confirmar_password']);

    if (empty($nueva_password) || empty($confirmar_password)) {
        $error = 'Por favor, completa todos los campos.';
    } elseif ($nueva_password !== $confirmar_password) {
        $error = 'Las contraseñas no coinciden.';
    } else {
        // Hashear la nueva contraseña
        $nueva_password_hash = password_hash($nueva_password, PASSWORD_DEFAULT);

        // Actualizar en la base de datos
        $stmt = $conn->prepare("UPDATE usuario SET password = ? WHERE username = ?");
        $stmt->bind_param('ss', $nueva_password_hash, $usuario);

        if ($stmt->execute()) {
            $success = 'Contraseña actualizada correctamente. Ahora puedes iniciar sesión.';
            session_destroy(); // Limpiar la sesión
        } else {
            $error = 'Error al actualizar la contraseña.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Restablecer Contraseña</h2>

            <script>
                <?php if ($error): ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '<?= $error ?>'
                    });
                <?php endif; ?>

                <?php if ($success): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: '<?= $success ?>'
                    }).then(() => {
                        window.location.href = 'index.php';
                    });
                <?php endif; ?>
            </script>

            <form action="restablecer_contrasena.php" method="POST">
                <div class="mb-3">
                    <label for="nueva_password" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="nueva_password" name="nueva_password" required>
                </div>
                <div class="mb-3">
                    <label for="confirmar_password" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
            </form>

            <div class="text-center mt-3">
                <a href="index.php" class="text-decoration-none">Volver al inicio de sesión</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
