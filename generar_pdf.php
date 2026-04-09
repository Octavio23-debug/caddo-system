<?php
require('fpdf/fpdf.php');
require('includes/config.php');

// Consulta: última recarga por sucursal hasta mayo 2025
$sql = "
    SELECT r.id, s.nombre AS sucursal, r.fecha
    FROM recargas r
    JOIN sucursal s ON r.id_suc = s.id
    JOIN (
        SELECT id_suc, MAX(fecha) AS fecha
        FROM recargas
        WHERE fecha <= '2025-07-14'
        GROUP BY id_suc
    ) ultimas ON r.id_suc = ultimas.id_suc AND r.fecha = ultimas.fecha
    ORDER BY r.fecha ASC
";

$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $pdf = new FPDF('P');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Última Recarga por Sucursal hasta Mayo 2025', 0, 1, 'C');
    $pdf->Ln(5);

    // Cabecera
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(15, 10, 'No.', 1);
    $pdf->Cell(80, 10, 'Sucursal', 1); // ancho generoso para nombres largos
    $pdf->Cell(30, 10, 'Fecha', 1);
    $pdf->Ln();

    // Cuerpo
    $pdf->SetFont('Arial', '', 10);
    $contador = 1;
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->Cell(15, 10, $contador++, 1);
        $pdf->Cell(80, 10, utf8_decode($fila['sucursal']), 1);
        $pdf->Cell(30, 10, $fila['fecha'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'recargas_unicas_por_sucursal.pdf');
} else {
    echo "No se encontraron registros para mostrar.";
}
?>