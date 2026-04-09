<?php
include 'includes/config.php'; // Asegúrate de que aquí se establece $conn

// Totales según campo "cajeras"
$sql1 = "SELECT 
            SUM(cajeras = 2) AS dos_cajeras, 
            SUM(cajeras = 1) AS una_cajera 
         FROM sucursal";
$result1 = $conn->query($sql1);
$data1 = $result1->fetch_assoc();

// Total de registros en cubriendo
$sql2 = "SELECT COUNT(*) AS total FROM cubriendo";
$result2 = $conn->query($sql2);
$data2 = $result2->fetch_assoc();

// Preparar JSON para JavaScript
echo json_encode([
    'dos_cajeras' => (int)$data1['dos_cajeras'],
    'una_cajera' => (int)$data1['una_cajera'],
    'cubriendo' => (int)$data2['total']
]);