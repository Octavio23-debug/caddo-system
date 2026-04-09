<?php
// obtener_notificaciones.php
include '../includes/config.php'; // Incluye la conexión a la base de datos

$query = "
    SELECT r.id, r.fecha, r.id_suc, s.nombre AS nombre_sucursal
    FROM recargas r
    JOIN sucursal s ON r.id_suc = s.id
    INNER JOIN (
        SELECT id_suc, MAX(fecha) AS ultima_fecha
        FROM recargas
        GROUP BY id_suc
    ) recargas_max ON r.id_suc = recargas_max.id_suc AND r.fecha = recargas_max.ultima_fecha
    WHERE DATE_ADD(r.fecha, INTERVAL 2 MONTH) <= CURDATE()
";

$result = $conn->query($query);
$notificaciones = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notificaciones[] = [
            'id' => $row['id'],
            'sucursal' => $row['nombre_sucursal'],
            'fecha' => $row['fecha']
        ];
    }
}

echo json_encode(['success' => true, 'notificaciones' => $notificaciones]);
?>
