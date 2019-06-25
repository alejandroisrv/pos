<?php
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \mPDF();
$html="

    <style>
    *{
      font-family:'Arial';
    }

    </style>
    <h1> Hola Mundo! </h1>
";
$mpdf->WriteHTML($html);
$mpdf->Output();

?>
