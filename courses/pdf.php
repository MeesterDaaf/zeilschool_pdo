<?php

require '../pdf/fpdf.php';

session_start();

$course = $_SESSION['course'];
$inschrijvingen = $_SESSION['inschrijvingen'];

class PDF extends FPDF
{



    // Better table
    function ImprovedTable($header, $data)
    {
        define('EURO', chr(128));
        // Column widths
        $w = array(30, 45, 50, 30);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
        // Data
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['id'], 'LR');
            $this->Cell($w[1], 6, $row['fName'], 'LR');
            $this->Cell($w[2], 6, $row['email']);
            $this->Cell($w[3], 6, EURO . $row['price']);
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}


$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->MultiCell(60, 10, $course['name']);

$header = array('id', 'Voornaam', 'Email', 'Prijs');
// Data loading
$pdf->SetFont('Arial', '', 14);

$pdf->ImprovedTable($header, $inschrijvingen);
$pdf->AddPage();

$pdf->Output();
