<?php
include '../includes/confg.php'; // Ajusta la ruta según tu estructura

$id = $_GET['id'];

$query = "SELECT * FROM recargas WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "success" => true,
        "id" => $row["id"],
        "sucursal" => $row["id_suc"],
        "fecha" => $row["fecha"],
        "monto" => $row["monto"],
        "usuario" => $row["id_user"],
        "fondo" => $row["fondo"],
        "folio" => $row["folio"],
        "factura" => $row["factura"]
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Registro no encontrado"
    ]);
}

$stmt->close();
$conn->close();
?>
