<?php

use Lenkowski\Cert\Certificate;
use Lenkowski\Cert\Implementation\MpdfCertificatePrinter;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../vendor/autoload.php';

$cert = new Certificate(
    'Marcin Lenkowski',
    Uuid::uuid4(),
    new \DateTimeImmutable('2021-09-01')
);

$printer = new MpdfCertificatePrinter(
    new \Mpdf\Mpdf()
);
$printer->printCertificate($cert);