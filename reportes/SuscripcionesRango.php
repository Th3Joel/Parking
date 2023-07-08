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
        $this->Cell(0, 9, 'Informe de Suscripciones', 0, 1, 'C', false);
        // Salto de l�nea
        $this->Ln(8);
    }

    function Tabla()
    {
        $this->AddPage('H', 'A4');
        $this->SetFont('Arial', 'B', 12);
        if($_GET["filtro"] == 0){
            $this->Cell(0, 7, 'Suscripciones activas por rango de fecha', 0, 0, 'C');
        }else if($_GET["filtro"] == 1){
            $this->Cell(0, 7, 'Suscripciones vencidas por rango de fecha', 0, 0, 'C');
        }
        
        $this->Cell(0, 7, 'Fecha: ' . $_GET["inicio"] . ' <> ' . $_GET["final"], 0, 1, 'R');

        $this->Ln(4);


        $r = Conexion::conectar()->prepare("EXEC SuscripcionesRangoFecha :inicio,:final,:tipo");
        $r->bindParam(":inicio",$_GET["inicio"],PDO::PARAM_STR);
        $r->bindParam(":final",$_GET["final"],PDO::PARAM_STR);
        $r->bindParam(":tipo",$_GET["filtro"],PDO::PARAM_INT);
        $r->execute();
        $h = $r->fetchAll(PDO::FETCH_ASSOC);

        // Anchuras de las columnas
        $w = array(15, 50, 50, 50, 30 ,30);

        if($_GET["filtro"] == 0){
            $header = array('#', 'Cliente', 
        'Vehiculo', 'Plan de suscripcion','Parqueo','Fecha Inicio');
        }else if($_GET["filtro"] == 1){
            $header = array('#', 'Cliente', 
        'Vehiculo', 'Plan de suscripcion','Parqueo','Vencimiento');
        }
        
        $this->SetX(35);

        // Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();

        foreach ($h as $key => $value) {
            $this->SetX(35);
            $this->Cell($w[0], 6, ($key + 1), 'LR', 0, 'C');
            $this->Cell($w[1], 6, $value['Cliente'], 'LR', 0, 'C');
            $this->Cell($w[2], 6, $value['Marca']." (".$value['Placa'].")", 'LR', 0, 'C');
            $this->Cell($w[3], 6, $value['NombrePlan'], 'LR', 0, 'C');
            $this->Cell($w[4], 6, $value['NumeroParqueo'], 'LR', 0, 'C');
            if($_GET["filtro"] == 0 ){
                $this->Cell($w[5], 6, $value['Fecha_Inicio'], 'LR', 0, 'C');
            }else if($_GET["filtro"] == 1){
                $this->Cell($w[5], 6, $value['Fecha_Final'], 'LR', 0, 'C');
            }
           
            $this->Ln();
        }
        $r = null;
        $h = null;
        // L�nea de cierre
        $this->SetX(35);
        $this->Cell(array_sum($w), 0, '', 'T');
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
