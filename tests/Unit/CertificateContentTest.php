<?php

use Lenkowski\Cert\Abstract\PdfPrinter;
use Lenkowski\Cert\Certificate;
use Lenkowski\Cert\Implementation\CertificatePrinter;
use Ramsey\Uuid\Uuid;

describe('Certificate content', function () {
    $pdfMock = Mockery::mock(PdfPrinter::class);

    it('should not destroy HTML structure', function () use ($pdfMock) {
        $cert = new Certificate(
            '<b>Marcin</b> <span>Lenkowski</span>',
            Uuid::uuid4(),
            new \DateTimeImmutable('2021-09-01'),
            'cert.pdf'
        );

        $printer = new CertificatePrinter($pdfMock);
        $html = (fn() => $this->getContent($cert))->call($printer);

        expect($html)->toContain('Marcin Lenkowski');
    });
});
