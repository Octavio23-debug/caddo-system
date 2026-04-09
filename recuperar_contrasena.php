<?php
session_start();
include 'includes/config.php';  // Incluye tu archivo de configuración

// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $codigo_ingresado = trim($_POST['codigo']);
    
    $codigo_correcto = '123456'; // Código fijo para pruebas (debería generarse dinámicamente en la base de datos)

    // Verificar que ambos campos no estén vacíos
    if (empty($usuario) || empty($codigo_ingresado)) {
        $error = 'Por favor, ingresa tu usuario y el código de validación.';
    } else {
        // Verificar si el usuario existe en la base de datos
        $stmt = $conn->prepare("SELECT id FROM usuario WHERE username = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Usuario encontrado, verificar código de validación
            if ($codigo_ingresado === $codigo_correcto) {
                // Guardar en sesión el usuario para el siguiente paso
                $_SESSION['usuario_recuperacion'] = $usuario;
                
                echo "<script>console.log('Código correcto. Redirigiendo a restablecer_contrasena.php');</script>";
                echo "<script>window.location.href = 'restablecer_contrasena.php';</script>";
                exit;
            } else {
                $error = 'Código de validación incorrecto.';
                echo "<script>console.error('Código incorrecto');</script>";
            }
        } else {
            $error = 'Usuario no encontrado.';
            echo "<script>console.error('Usuario no encontrado');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h2 class="text-center mb-4">Recuperar Contraseña</h2>
        
        <script>
            <?php if (!empty($error)): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?= $error ?>'
                });
            <?php endif; ?>
        </script>

        <form action="recuperar_contrasena.php" method="POST">
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Introduce tu usuario" required>
            </div>
            <div class="mb-3">
                <label for="codigo" class="form-label">Código de Validación</label>
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Introduce el código de validación" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Validar Código</button>
        </form>

        <p class="text-center mt-3"><a href="index.php">Volver al inicio de sesión</a></p>
    </div>
</body>
</html>
