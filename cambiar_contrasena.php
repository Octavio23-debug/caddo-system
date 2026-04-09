<?php
session_start();
require_once 'includes/config.php'; // Conexión a la base de datos
// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $password_actual = trim($_POST['password_actual']);
    $password_nueva = trim($_POST['password_nueva']);
    $password_confirmar = trim($_POST['password_confirmar']);

    if (empty($password_actual) || empty($password_nueva) || empty($password_confirmar)) {
        $error = "⚠️ Todos los campos son obligatorios.";
    } elseif ($password_nueva !== $password_confirmar) {
        $error = "❌ Las contraseñas nuevas no coinciden.";
    } elseif (strlen($password_nueva) < 6) {
        $error = "🔑 La nueva contraseña debe tener al menos 6 caracteres.";
    } else {
        $sql = "SELECT password FROM usuario WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($password_hash);
            $stmt->fetch();

            if (password_verify($password_actual, $password_hash)) {
                $password_nueva_hash = password_hash($password_nueva, PASSWORD_BCRYPT);
                $sql_update = "UPDATE usuario SET password = ? WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("si", $password_nueva_hash, $user_id);

                if ($stmt_update->execute()) {
                    $message = "✅ Contraseña actualizada correctamente.";
                } else {
                    $error = "⚠️ Error al actualizar la contraseña. Intenta de nuevo.";
                }
                $stmt_update->close();
            } else {
                $error = "❌ La contraseña actual es incorrecta.";
            }
        } else {
            $error = "⚠️ Usuario no encontrado.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Cambiar Contraseña</h2>

        <!-- Mostrar mensaje de éxito -->
        <?php if (!empty($message)): ?>
            <script>
                Swal.fire({
                    icon: "success",
                    title: "¡Éxito!",
                    text: "<?php echo $message; ?>",
                    confirmButtonColor: "#3085d6"
                }).then(() => {
                    window.location.href = "index.php"; // Redirigir al inicio
                });
            </script>
        <?php endif; ?>

        <!-- Mostrar errores en la consola -->
        <?php if (!empty($error)): ?>
            <script>
                console.error("Error: <?php echo $error; ?>");
            </script>
        <?php endif; ?>

        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Contraseña Actual</label>
                        <input type="password" name="password_actual" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password_nueva" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmar" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Actualizar Contraseña</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="index2.php" class="btn btn-secondary">Volver al inicio</a>
        </div>
    </div>
</body>
</html>
