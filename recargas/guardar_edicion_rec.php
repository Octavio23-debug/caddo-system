<?php
// Incluye la conexión a la base de datos
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica que todos los datos necesarios hayan sido enviados
    $id = $_POST["id"];
    $sucursal = $_POST["id_suc"];
    $fecha = $_POST["fecha"];
    $monto = $_POST["monto"];
    $usuario = $_POST["usuario"];
    $fondo = $_POST["fondo"];
    $folio = $_POST["folio"];
    $factura = $_POST["factura"];

    // Valida los datos ingresados (puedes añadir más validaciones si es necesario)
    if (empty($id) || empty($fecha) || empty($monto) || empty($fondo) || empty($folio)) {
        echo "<script>
                alert('Todos los campos son obligatorios.');
                window.history.back();
              </script>";
        exit;
    }

    // Consulta preparada para actualizar los datos
    $query = "UPDATE recargas 
              SET id_suc = ?, fecha = ?, monto = ?, id_user = ?, fondo = ?, folio = ?, factura = ? 
              WHERE id = ?";
    
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("ssissssi", $sucursal, $fecha, $monto, $usuario, $fondo, $folio, $factura, $id);
        
        if ($stmt->execute()) {
            echo "<script>
                    alert('Recarga actualizada exitosamente.');
                    window.location.href = '../index.php'; 
                  </script>";
        } else {
            echo "<script>
                    alert('Error al actualizar la recarga: " . $stmt->error . "');
                    window.history.back();
                  </script>";
        }
        
        $stmt->close();
    } else {
        echo "<script>
                alert('Error en la preparación de la consulta: " . $conn->error . "');
                window.history.back();
              </script>";
    }

    $conn->close();
} else {
    echo "<script>
            alert('Acceso no autorizado.');
            window.location.href = '../index.php';
          </script>";
}
?>
