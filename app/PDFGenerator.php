<?php

namespace App;

class PDFGenerator
{
    public static function generatePDFPath($name, $viewData)
    {
        $storagePath = storage_path('tmp/pdf/');
        $randomSubdir = time() . '_' . rand(1000, 99999);
        $filename = '/' . $name . '.pdf';
        $pdf = \PDF::loadView('newsletter.attachment', $viewData);

        $pdf->setPaper('a4')->save($storagePath . $randomSubdir . $filename);

        return($storagePath . $randomSubdir . $filename);

    }
}