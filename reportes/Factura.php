<?php
require "pdf/fpdf.php";
require "../controller/suscripciones.controller.php";
class PDF extends FPDF
{
    function Header()
    {

        $this->Image("logo.png",0,0,35,35);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Calculamos ancho y posici�n del t�tulo.

        // Colores de los bordes, fondo y texto

        // Ancho del borde (1 mm)
        //$this->SetLineWidth(1);
        // T�tulo
        $this->Cell(0, 9, 'Reporte de facturacion', 0, 1, 'C', false);
        // Salto de l�nea
        $this->Ln(7);
    }

    function Tabla()
    {
        $datos = ControlSuscripciones::Detalle($_GET["id"], true);
        $total = $datos["factura"]["Total"];
        unset($datos["factura"]["Total"]);


        $this->AddPage('', 'A4');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 7, 'Fecha: '.Date("Y-m-d"), 0, 1, 'R');
        $this->Cell(50, 7, 'Registrado por: ', 'LT', 0, 'C');
        $this->Cell(0, 7, $datos["datos"]["Usuario"], 'RT', 1, 'C');
        $this->Cell(50, 7, 'Cliente: ', 'BL', 0, 'C');
        $this->Cell(0, 7, $datos["datos"]["Cliente"], 'BR', 1, 'C');
        $this->Cell(50, 7, 'Parqueo: ' . $datos["datos"]["NumeroParqueo"], 'L', 0, 'C');
        $this->Cell(60, 7, 'Plan: ' . $datos["datos"]["NombrePlan"], 'L', 0, 'C');
        $this->Cell(0, 7, 'Facturacion: ' . $datos["datos"]["Duracion"] . ' (C$ ' . $datos["datos"]["PrecioPlan"] . ')', 'R', 1, 'C');
        function Ttime($r)
        {
            switch ($r) {
                case 'Diario':
                    return 'Dias';
                    break;
                case 'Semanal':
                    return 'Semanas';
                    break;
                case 'Mensual':
                    return 'Meses';
                    break;
                case 'Anual':
                    return 'Anios';
                    break;
            }
        }
        $this->Cell(50, 7, 'Duracion: '.$datos["datos"]["CantidadTiempo"].' '.Ttime($datos["datos"]["Duracion"]), 'LB', 0, 'C');

        $this->Cell(70, 7, 'Fecha de inicio: ' . $datos["datos"]["Fecha_Inicio"], 'LTB', 0, 'C');
        $this->Cell(0, 7, 'Vencimiento: ' . $datos["datos"]["Fecha_Final"], 'RTB', 1, 'C');
        //$this->Cell(0,7,'Fecha: '.date('Y-m-d'),0,1,'R');

        $this->Ln(4);

        // Anchuras de las columnas
        $w = array(20, 45, 45, 35);
        $header = array(Ttime($datos["datos"]["Duracion"]), 'Fecha', 'Deuda', 'Subtotal');

        $this->SetX(35);

        // Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();

        foreach ($datos["factura"] as $key => $value) {
            $this->SetX(35);
            $this->Cell($w[0], 6,$key, 'LR', 0, 'C');
            $this->Cell($w[1], 6, $value['Fecha'], 'LR', 0, 'C');
            if ($value["Deuda"] == "Pendiente") {
                $this->SetTextColor(166,50,25);
                $this->Cell($w[2], 6, $value['Deuda'], 'LR', 0, 'C');
                $this->Cell($w[3], 6,$value['subtotal'], 'LR', 0, 'R');
            }else{
                $this->SetTextColor(55,146,37);
                $this->Cell($w[2], 6, $value['Deuda'], 'LR', 0, 'C');
                $this->Cell($w[3], 6,$value['subtotal'], 'LR', 0, 'R');
            }
            $this->SetTextColor(0,0,0);          
            $this->Ln();
        }

        // L�nea de cierre
        $this->SetX(35);
        $this->Cell(array_sum(array($w[0], $w[1], $w[2])), 6, 'Total', 1, 0, 'C');
        $this->Cell($w[3], 6, $total, 'RTB', 1, 'C');
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
$pdf->Output();
