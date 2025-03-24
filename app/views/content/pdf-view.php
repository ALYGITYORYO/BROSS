<?php
namespace app\lib;


class MiControlador extends \app\controllers\BaseController {
    public function generarPdf() {
        require_once APP_PATH . 'lib/fpdf/fpdf.php'; // Usa APP_PATH si lo tienes definido
        // o usa una ruta relativa correcta:
        // require_once '../../libraries/fpdf/fpdf.php';

      

        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, '¡Hola, PDF!');
        $pdf->Output('mi_archivo.pdf', 'D'); // 'D' para descargar
    }
}
?>