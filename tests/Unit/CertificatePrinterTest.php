<?php

use Lenkowski\Cert\Abstract\PdfPrinter;
use Lenkowski\Cert\Certificate;
use Lenkowski\Cert\Implementation\CertificatePrinter;
use Ramsey\Uuid\Uuid;

describe('Certificate printer', function () {
    $pdfMock = Mockery::mock(PdfPrinter::class);
    $uuid = Uuid::uuid4();
    $cert = new Certificate(
        'Marcin Lenkowski',
        $uuid,
        new \DateTimeImmutable('2021-09-01'),
        'cert.pdf'
    );

    it('should print certificate', function () use ($pdfMock, $uuid, $cert) {
        $pdfMock->shouldReceive('setAuthor')->with($cert->getIssuer())->once();
        $pdfMock->shouldReceive('setSourcePdf')->with($cert->getTemplate())->once();
        $pdfMock->shouldReceive('writeHtml')->once();
        $pdfMock->shouldReceive('print')->with($cert->getFilename())->once();

        $printer = new CertificatePrinter($pdfMock);
        $printer->printCertificate($cert);
    });

    it('should return html content', function () use ($pdfMock, $uuid, $cert) {
        $printer = new CertificatePrinter($pdfMock);
        $html = (fn() => $this->getContent($cert))->call($printer);

        expect($html)->toContain('Marcin Lenkowski', '2021-09-01', $cert->getNumber());
    });
});
