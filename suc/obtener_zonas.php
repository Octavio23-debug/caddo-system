<?php
include '../includes/config.php';

header('Content-Type: application/json');

$sql = "
SELECT 
    z.id,
    z.nombre,
    IFNULL(GROUP_CONCAT(a.nombre SEPARATOR ', '), 'Sin asignar') AS encargada_o
FROM zona z

LEFT JOIN sucursal s 
    ON s.id_zona = z.id

LEFT JOIN agenda a 
    ON a.sucursal = s.id 
    AND a.cargo LIKE '%Encargad%'
    AND a.estado = 'Alta'

GROUP BY z.id, z.nombre
ORDER BY z.id
";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $zonas = [];

    while ($row = $result->fetch_assoc()) {
        $zonas[] = [
            'id_zona' => $row['id'],
            'nombre' => $row['nombre'],
            'encargada_o' => $row['encargada_o']
        ];
    }

    echo json_encode([
        'success' => true,
        'data' => $zonas
    ]);
} else {
    echo json_encode([
        'success' => false,
        'data' => []
    ]);
}

$conn->close();
?>