<?php

namespace Lenkowski\Cert\Implementation;

use Lenkowski\Cert\Abstract\PdfPrinter;
use Lenkowski\Cert\Certificate;

class CertificatePrinter implements \Lenkowski\Cert\Abstract\CertificatePrinter
{
    public function __construct(private PdfPrinter $mpdf)
    {
    }

    public function printCertificate(Certificate $cert): void
    {
        $this->mpdf->setAuthor($cert->getIssuer());
        $this->mpdf->setSourcePdf($cert->getTemplate());
        $this->mpdf->writeHtml($this->getContent($cert));
        $this->mpdf->print($cert->getFilename());
    }

    private function getContent(Certificate $cert): string
    {
        $html = <<<EOD
<h1 style="position:absolute; left:0; top:450px; margin:0 10px; text-align: center; align-self:center; width: 100%; font-family: sans-serif;">{{name}}</h1>
<div style="position: absolute; left:0; top:350px; width: 100%; text-align: center;">Numer: {{number}}</div>
<div style="position: absolute; top:895px; left:450px;">{{issued_at}}</div>
EOD;

        $html = str_replace('{{name}}', $cert->getName(), $html);
        $html = str_replace('{{number}}', $cert->getNumber(), $html);
        $html = str_replace('{{issued_at}}', $cert->printIssuedAt(), $html);
        return $html;
    }
}