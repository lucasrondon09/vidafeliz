<?php

namespace App\Libraries;

use Mpdf\Mpdf;

class PdfGenerator
{
    protected $mpdf;

    public function __construct()
    {
        $this->mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P'
        ]);
    }

    public function generate(string $html, string $filename = 'documento.pdf', string $outputMode = 'I'): string
    {
        $this->mpdf->WriteHTML($html);
        return $this->mpdf->Output($filename, $outputMode);
        exit;
    }

}
