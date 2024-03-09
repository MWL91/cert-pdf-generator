<?php

require_once __DIR__ . '/../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$html = '<h1>Hello World</h1>';
$mpdf->WriteHTML($html);
$mpdf->Output();
