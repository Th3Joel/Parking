<?php
require "pdf/fpdf.php";
require "../model/db.php";
class PDF extends FPDF
{
    function Header()
    {

        $this->Image("logo.png",0,0,40,40);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Calculamos ancho y posici�n del t�tulo.

        // Colores de los bordes, fondo y texto

        // Ancho del borde (1 mm)
        //$this->SetLineWidth(1);
        // T�tulo
        $this->Cell(0, 9, 'Informe de parqueos', 0, 1, 'C', false);
        // Salto de l�nea
        $this->Ln(2);
    }

    function Tabla()
    {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 12);
        if($_GET["state"] == 0){
            $this->Cell(0, 7, 'Paqueos Libres', 0, 0, 'C');
        }else if($_GET["state"] == 1){
            $this->Cell(0, 7, 'Paqueos Ocupados', 0, 0, 'C');
        }
       
        $this->Cell(0,7,'Fecha: '.date('Y-m-d'),0,1,'R');

        $this->Ln(4);
        
        $stat = $_GET["state"] == 0 ? "Libre" : "Ocupado";

        $r = Conexion::conectar()->prepare('SELECT * FROM parqueos WHERE Estado = :status');
        $r->bindParam(":status",$stat,PDO::PARAM_STR);
        $r->execute();
        $h = $r->fetchAll(PDO::FETCH_ASSOC);

        // Anchuras de las columnas
        $w = array(10, 35);
        $header = array('#','Identificador');
        $this->SetX(85);

        // Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();

            
        foreach ($h as $key => $value) {
            $this->SetX(85);
            $this->Cell($w[0], 6, ($key+1), 'LR',0,'C');
            $this->Cell($w[1], 6, $value['NumeroParqueo'], 'LR',0,'C');
            $this->Ln();
        }
        $r = null;
        $h = null;
        // L�nea de cierre
        $this->SetX(85);
        $this->Cell(array_sum($w), 0, '', 'T',1);
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
$pdf->Output("I","Estado de parqueos");
