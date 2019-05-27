<?php
require_once("config.php");
require('alphapdf.php');
$pdf = new AlphaPDF();
$pdf->AddPage();


$pdf->SetAlpha(0.3);
$pdf->Image('images/background.jpg',0,0,210,300);

$pdf->SetAlpha(1);
$pdf->SetFont('Arial','B',18);	
$pdf->Cell(0,100,'Menu Nutrition:',0,0,'C');
$pdf->Ln();
$pdf->Cell(0,10,'Report Generated to Show Nutritional Values',0,0,'C'); 
$pdf->Ln();
$pdf->Cell(0,10,'of All Menu Items and Produce Items',0,0,'C');
$pdf->Ln();

$stmt = "SELECT * FROM item_nutrition;";
$result = pg_query($dbconn,$stmt);

$stmt2 = "SELECT * FROM item_produce ORDER BY item;";
$produce = pg_query($dbconn,$stmt2);

$count = 1;
$prod = pg_fetch_row($produce, 0);

for($i = 0; $i < pg_num_rows($result); $i++) {
    $row = pg_fetch_row($result, $i);
    if($i%15 == 0) {
	$pdf->AddPage();


	$pdf->SetAlpha(0.3);
	$pdf->Image('images/background.jpg',0,0,210,300);

	$pdf->SetAlpha(1);
	$pdf->Ln();
	$pdf->SetFont('Arial','B',12);	
	$pdf->Cell(0,20,$row[0].':');
	$pdf->SetFont('Arial','B',10);
	while($prod[1] == $row[0]) {	
	    $pdf->Ln();
	    $pdf->Cell(30,5,$prod[0]);
	    $count += 1;
	    $prod = pg_fetch_row($produce, $count);
	}
	$pdf->Ln();
	$pdf->Cell(0,5,'---------------------------------------------------------------------------------------------------------------');
	$pdf->SetFont('Arial','B',10);
    }
    $pdf->Ln();
    $pdf->Cell(50,5,$row[1].':');
    $pdf->Cell(1,5,$row[2]);

}

$stmt = "SELECT * FROM produce_health ORDER BY item, nutrition;";
$result = pg_query($dbconn, $stmt);
for($i = 0; $i < pg_num_rows($result); $i += 15) {
    $row = pg_fetch_row($result, $i);
    $pdf->AddPage();

    $pdf->SetAlpha(0.3);
    $pdf->Image('images/background.jpg',0,0,210,300);

    $pdf->SetAlpha(1);
    $pdf->SetFont('Arial','B',12);	
    $pdf->Cell(0,20,$row[0].':');
    $pdf->SetFont('Arial','B',10);
    for($k = 0; $k < 15; $k++){
	$j = $i + $k;
	$row = pg_fetch_row($result,$j);
	$pdf->Ln();
	$pdf->Cell(40,5,$row[1].':');
	$pdf->Cell(30,5,$row[2]);
    }
}

$pdf->Output();
?>
