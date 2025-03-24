<?php
require('fpdf.php'); // Asegúrate de que la ruta sea correcta

class PDF extends FPDF
{
    function Header()
    {
        // Logo (opcional)
         $this->Image('../../views/images/bross_logo.png', 10, 8, 33);

        // Fuente y tamaño para el encabezado
        $this->SetFont('Arial', 'B', 9);

        // Título
        $this->Cell(0, 9, 'MARIA BRENDA SERVIN VELAZQUEZ', 0, 1, 'C');

        // Dirección
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, 'PINO #6, HUAJUMBARO, CD, HIDALGO', 0, 1, 'C');
        $this->Cell(0, 5, 'MICHOACAN, MEXICO, C.P. 61220', 0, 1, 'C');

        // Información adicional
        $this->Cell(0, 5, 'RFC: SEVB740719GU3', 0, 1, 'C');
        $this->Cell(0, 5, 'bross.logistic@gmail.com Tel. 443 323 45 63', 0, 1, 'C');
        $this->Cell(0, 5, 'REGIMEN FISCAL: 612 - Personas Fisicas con Actividades Empresariales y Profesionales', 0, 1, 'C');

        // Salto de línea
        $this->Ln(9);
    }

    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);

        // Fuente Arial italic 8
        $this->SetFont('Arial', 'I', 7);

        // Número de página
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    
    function tabla_detalle($data){
        $this->SetFont('Arial', '', 7);

        $encabezados = array('Cantidad', 'Unidad de Medida', 'Conceptos', 'Precio Unitario', 'Importe antes desc', '%Dcto', 'Subtotal');
        $ancho_celda = array(15, 25, 60, 25, 25, 15, 25);

        for ($i = 0; $i < count($encabezados); $i++) {
            $this->Cell($ancho_celda[$i], 5, $encabezados[$i], 1, 0, 'C');
        }
        $this->Ln();

        foreach ($data as $fila) {
            $unidadLines = explode("\n", $fila[1]);
            $unidadHeight = count($unidadLines) * 5; // Ajusta el 5 según el tamaño de la fuente y el espaciado

            $this->Cell($ancho_celda[0], $unidadHeight, $fila[0], 1, 0, 'C');

            $currentY = $this->GetY();
            $this->MultiCell($ancho_celda[1], 5, $fila[1], 1, 'C');
            $this->MultiCell($ancho_celda[1], 5, $fila[1], 1, 'C');
            $this->SetXY($this->GetX() + $ancho_celda[1], $currentY);

            $this->Cell($ancho_celda[2], 10, $fila[2], 1, 0, 'C');
            $this->Cell($ancho_celda[3], 10, $fila[3], 1, 0, 'C');
            $this->Cell($ancho_celda[4], 10, $fila[4], 1, 0, 'C');
            $this->Cell($ancho_celda[5], 10, $fila[5], 1, 0, 'C');
            $this->Cell($ancho_celda[6], 10, $fila[6], 1, 0, 'C');
            
            $this->Ln();
        }
    }

    function CuadroTexto($x, $y, $w, $h, $txt) {
        $this->SetFont('Arial', '', 7);
        $this->Rect($x, $y, $w, $h);
        $this->SetXY($x + 2, $y + 2);
        $this->MultiCell($w - 4, 5, $txt);
    }

    function LineaHorizontal($y) {
        $this->Line(5, $y, 205, $y);
    }

}


// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Información del cliente
$pdf->LineaHorizontal(45);

// Cuadro de texto para información del cliente
$clienteTxt = "Cliente: DEACERO SAPI DE C.V.\n" .
              "Domicilio: AVENIDA LAZARO CARDENAS 2333, ZONA LOMA LARGA ORIENTE, C.P:66266\n" .
              "SAN PEDRO GARZA GARCIA, NUEVO LEON NUEVO LEON, MEXICO\n" .
              "R.F.C: DEA7103086X2\n" .
              "Regimen Fiscal 601 General de Ley Personas Morales";
$pdf->CuadroTexto(5, 50, 90, 35, $clienteTxt);

// Cuadro de texto para observaciones
$observacionesTxt = "Observaciones: DEACERO\n" .
                    "MORELIA-MONTERREY\n" .
                    "OPERADOR: RICARDO GIOVANNI ANGUIANO PINON\n" .
                    "PLACAS: 16AS9J\n" .
                    "NO. VIAJE: 94000\n" .
                    "FECHA DE CARGA: 08-FEBRERO-2025";
$pdf->CuadroTexto(115, 50, 90, 35, $observacionesTxt);

$pdf->Ln();
$pdf->Ln();
// Tabla de conceptos
// Datos de la tabla
$datos = array(
    array(1.00, "E48 UNIDAD \n DE SERVICIO", "FLETE", '$21,164.00', '$21,164.00', '$0.00', '$21,164.00')
);

// Generar tabla
$pdf->tabla_detalle($datos);

// Impuestos
$pdf->Ln(10);
$pdf->Cell(0, 5, 'Impuestos:', 0, 1);
$pdf->Cell(0, 5, '002 IVA Base: $21,164.00 Tasa: 0.160000 Importe: $3,386.24', 0, 1);
$pdf->Cell(0, 5, '002 Ret IVA: Tipo Factor: Tasa Tasa o Cuota: 0.040000 Importe: $846.56', 0, 1);

// Salida del PDF
$pdf->Output('factura.pdf', 'I'); // 'D' para descarga, 'I' para mostrar en el navegador
?>