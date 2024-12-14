<?php
require "pdf/fpdf.php";
require "../model/db.php";
class PDF extends FPDF
{
    function Header()
    {

        $this->Image("logo.png", 0, 0, 40, 40);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Calculamos ancho y posici�n del t�tulo.

        // Colores de los bordes, fondo y texto

        // Ancho del borde (1 mm)
        //$this->SetLineWidth(1);
        // T�tulo
        $this->Cell(0, 9, 'Informe de ventas', 0, 1, 'C', false);
        // Salto de l�nea
        $this->Ln(2);
    }

    function Tabla()
    {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 7, 'Total a pagar de clientes', 0, 0, 'C');
        $this->Cell(0, 7, 'Fecha: ' . date('Y-m-d'), 0, 1, 'R');

        $this->Ln(4);


        $r = Conexion::conectar()->prepare("SpTopClientes");
        $r->execute();

        $h = $r->fetchAll(PDO::FETCH_ASSOC);

        // Anchuras de las columnas
        $w = array(40, 35, 45);
        $header = array('Nombre', 'Apellido', 'Total');
        $this->SetX(45);

        // Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();

        $total = 0;
        foreach ($h as $key => $value) {
            $this->SetX(45);
            $this->Cell($w[0], 6, $value['Nombre'], 'LR', 0, 'C');
            $this->Cell($w[1], 6, $value['Apellido'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, 'C$ ' . number_format($value['TOTAL FACTURADO']), 'LR', 0, 'R');
            $this->Ln();
            $total += $value["TOTAL FACTURADO"];
        }
        $r = null;
        $h = null;
        // L�nea de cierre
        $this->SetX(45);
        $this->Cell(array_sum(array($w[0], $w[1])), 0, '', 'T', 0);
        $this->Cell($w[2], 6, "C$ " . number_format($total), 1, 0, 'C');
    }

    function Footer()
    {
        // Posici�n a 1,5 cm del final
        $this->SetY(-15);
        // Arial it�lica 8
        $this->SetFont('Arial', 'I', 8);
        // Color del texto en gris
        $this->SetTextColor(128);
        // N�mero de p�gina
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->Tabla();
$pdf->Output("I", "Totales de pagos de clientes");
