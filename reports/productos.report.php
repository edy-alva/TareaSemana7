<?php
require_once 'fpdf/fpdf.php';
require '../models/productos.model.php';

$productos = new Productos();
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',24);
$pdf->Text(40, 10, iconv('UTF-8','Windows-1252', '¡Hola, Mundo!'));
$pdf->SetFont('Arial','I',10);

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$texto = 'Podríamos haber especificado itálica con I, subrayado con U o normal con una cadena vacía (o cualquier combinación de las anteriores). Observe que el tamaño de la fuente se detemina en puntos, no en milímetros (ni en cualquier otra unidad establecida por el usuario)';
$pdf->MultiCell(0, 5, iconv('UTF-8','Windows-1252', $texto),0,'J');

$listaproductos = $productos->todos();
$x = 20;
$y = 50;
$altoCelda = 7;

$pdf->Cell(10, $altoCelda, 'No', 1, 0, 'C');
$pdf->Cell(40, $altoCelda, 'Codigo', 1, 0, 'C');
$pdf->Cell(100, $altoCelda, 'Nombre', 1, 0, 'C');
$pdf->Cell(20, $altoCelda, 'Graba IVA', 1, 0, 'C');
$pdf->Ln();
$index = 1;
while ($prod = mysqli_fetch_assoc($listaproductos)) {
    $pdf->Cell(10, $altoCelda, $index, 1, 0, 'C');
    $pdf->Cell(40, $altoCelda, $prod['Codigo_Barras'], 1, 0, 'C');
    $pdf->Cell(100, $altoCelda, $prod['Nombre_Producto'], 1, 0, 'C');
    $pdf->Cell(20, $altoCelda,  $prod['Graba_IVA'], 1, 0, 'C');
    $pdf->Ln();
    $y += 7;
    $index++;
};
$pdf->Image('https://img.freepik.com/vector-gratis/vector-degradado-logotipo-colorido-pajaro_343694-1365.jpg', 10, 220, 20, 20, 'JPG');



$pdf->Output();