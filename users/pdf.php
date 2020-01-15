<?php

require '../pdf/fpdf.php';

session_start();

$user = $_SESSION['user'];
$inschrijvingen = $_SESSION['inschrijvingen'];

class PDF extends FPDF
{
    protected $totalPrice;


    // Better table
    function ImprovedTable($header, $data)
    {
        define('EURO', chr(128));
        // Column widths
        $w = array(30, 50, 30);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Data

        $this->totalPrice = 0;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['id'], 'LR');
            $this->Cell($w[1], 6, $row['name'], 'LR');
            $this->Cell($w[2], 6, EURO . $row['price'], 'R');
            $this->Ln();
            $this->totalPrice += $row['price'];
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function getTotalPrice()
    {
        $this->LN();
        return "Totaalprijs: " . EURO . " " . $this->totalPrice;
    }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->MultiCell(60, 10, $user['fName']);
$pdf->LN();
$pdf->MultiCell(60, 10, "Factuur Courses");


$header = array('ID', 'Cursus', 'Prijs');
// Data loading
$pdf->SetFont('Arial', '', 14);

$pdf->ImprovedTable($header, $inschrijvingen);

$pdf->LN();
$pdf->SetFont('Arial', 'B', 22);
$pdf->MultiCell(100, 20, $pdf->getTotalPrice());


$pdf->Output();
