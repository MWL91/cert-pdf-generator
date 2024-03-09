<?php

use Lenkowski\Cert\Certificate;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

// Specify a PDF template
$pagecount = $mpdf->setSourceFile('cert.pdf');

// Import the last page of the source PDF file
$tplId = $mpdf->importPage($pagecount);
$mpdf->UseTemplate($tplId);

$html=<<<EOD
<h1 style="position:absolute; left:0; top:450px; margin:0 10px; text-align: center; align-self:center; width: 100%; font-family: sans-serif;">Marcin Lenkowski</h1>
<div style="position: absolute; left:0; top:350px; width: 100%; text-align: center;">Numer: 1234-5678-9012</div>
<div style="position: absolute; top:895px; left:450px;">2024-03-10 15:00</div>
EOD;

$mpdf->WriteHTML($html);
$mpdf->Output();
