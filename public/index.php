<?php

use Lenkowski\Cert\Certificate;
use Lenkowski\Cert\Implementation\MpdfCertificatePrinter;
use Lenkowski\Cert\Implementation\Printers\MpdfPrinterAdapter;
use Mpdf\Mpdf;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$cert = new Certificate(
    'Marcin Lenkowski',
    Uuid::uuid4(),
    new \DateTimeImmutable('2021-09-01'),
    __DIR__ . '/cert.pdf'
);

$printer = new MpdfCertificatePrinter(
    new MpdfPrinterAdapter(new Mpdf)
);
$printer->printCertificate($cert);