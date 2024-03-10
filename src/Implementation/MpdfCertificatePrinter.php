<?php

namespace Lenkowski\Cert\Implementation;

use Lenkowski\Cert\Abstract\CertificatePrinter;
use Lenkowski\Cert\Certificate;
use Mpdf\Mpdf;

class MpdfCertificatePrinter implements CertificatePrinter
{
    public function __construct(private Mpdf $mpdf)
    {
    }

    public function printCertificate(Certificate $cert): void
    {
        $this->mpdf->SetAuthor($cert->getIssuer());

        // Specify a PDF template
        $pagecount = $this->mpdf->setSourceFile(__DIR__ . '/../../public/cert.pdf');

        // Import the last page of the source PDF file
        $tplId = $this->mpdf->importPage($pagecount);
        $this->mpdf->UseTemplate($tplId);

        $html=<<<EOD
<h1 style="position:absolute; left:0; top:450px; margin:0 10px; text-align: center; align-self:center; width: 100%; font-family: sans-serif;">{{name}}</h1>
<div style="position: absolute; left:0; top:350px; width: 100%; text-align: center;">Numer: {{number}}</div>
<div style="position: absolute; top:895px; left:450px;">{{issued_at}}</div>
EOD;

        $html = str_replace('{{name}}', $cert->getName(), $html);
        $html = str_replace('{{number}}', $cert->getNumber(), $html);
        $html = str_replace('{{issued_at}}', $cert->printIssuedAt(), $html);

        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output();
    }
}