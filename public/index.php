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

$mpdf->Output();
