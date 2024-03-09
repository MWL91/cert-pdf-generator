<?php

use Lenkowski\Cert\Certificate;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$cert = new Certificate(
    'Marcin Lenkowski',
    Uuid::uuid4(),
    new DateTimeImmutable('2021-09-01')
);

$mpdf = new \Mpdf\Mpdf();

$mpdf->SetAuthor($cert::ISSUER);

// Specify a PDF template
$pagecount = $mpdf->setSourceFile('cert.pdf');

// Import the last page of the source PDF file
$tplId = $mpdf->importPage($pagecount);
$mpdf->UseTemplate($tplId);

$html=<<<EOD
<h1 style="position:absolute; left:0; top:450px; margin:0 10px; text-align: center; align-self:center; width: 100%; font-family: sans-serif;">{{name}}</h1>
<div style="position: absolute; left:0; top:350px; width: 100%; text-align: center;">Numer: {{number}}</div>
<div style="position: absolute; top:895px; left:450px;">{{issued_at}}</div>
EOD;

$html = str_replace('{{name}}', $cert->getName(), $html);
$html = str_replace('{{number}}', $cert->getNumber(), $html);
$html = str_replace('{{issued_at}}', $cert->printIssuedAt(), $html);

$mpdf->WriteHTML($html);
$mpdf->Output();
