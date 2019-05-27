<?php
require_once("config.php");
require('diag.php');

$pdf = new PDF_Diag();
$pdf->AddPage();

$stmt = "SELECT name, sum(price) from c_order NATURAL JOIN menu_items GROUP BY name;";
$result = pg_query($dbconn, $stmt);

$data = array();
for($i = 0; $i < pg_num_rows($result); $i++) {
    $row = pg_fetch_row($result);
    $data += array($row[0] => number_format($row[1], 2));
}

$pdf->SetFont('Arial', 'BIU', 12);
$pdf->Cell(0, 5, 'Sandwhich Purchase Rate', 0, 1);
$pdf->Ln(8);
$valX = $pdf->GetX();
$valY = $pdf->GetY();
$pdf->BarDiagram(200,260, $data, "%l:\t%v\t(%p)", array(34,139,34));
$pdf->SetXY($valX, $valY + 80);

$pdf->Output();
?>
