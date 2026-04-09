<?php
include '../includes/config.php'; // Incluye la conexión a la base de datos

$id = $_GET['id'] ?? null;

$recarga = null;

if ($id) {
    $query = "SELECT recargas.id, recargas.fecha, sucursal.nombre
              FROM recargas
              JOIN sucursal ON recargas.id_suc = sucursal.id
              WHERE recargas.id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $recarga = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Recarga</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if ($recarga): ?>
                Swal.fire({
                    title: "Detalle de Recarga",
                    html: `
                        <p><strong>Sucursal:</strong> <?php echo $recarga['nombre']; ?></p>
                        <p><strong>Fecha de Recarga:</strong> <?php echo $recarga['fecha']; ?></p>
                        <p><strong>Estado:</strong> Por terminar o terminada</p>
                    `,
                    icon: "info",
                    confirmButtonText: "Cerrar"
                }).then(function() {
                    // Redirigir a index2.php en la raíz
                    window.location.href = '../index2.php';
                });
            <?php else: ?>
                Swal.fire({
                    title: "Error",
                    text: "No se encontró información sobre esta recarga.",
                    icon: "error",
                    confirmButtonText: "Cerrar"
                }).then(function() {
                    // Redirigir a index2.php en la raíz
                    window.location.href = '../index2.php';
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>
