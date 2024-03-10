<?php

namespace Lenkowski\Cert\Implementation\Printers;

use Lenkowski\Cert\Abstract\PdfPrinter;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class MpdfPrinterAdapter implements PdfPrinter
{
    public function __construct(private Mpdf $mpdf)
    {
    }

    public function setAuthor(string $author): void
    {
        $this->mpdf->SetAuthor($author);
    }

    public function setSourcePdf(string $path): void
    {
        $pagecount = $this->mpdf->setSourceFile($path);
        $tplId = $this->mpdf->importPage($pagecount);
        $this->mpdf->UseTemplate($tplId);
    }

    public function writeHtml(string $html): void
    {
        $this->mpdf->WriteHTML($html);
    }

    public function print(string $name = ''): void
    {
        $this->mpdf->Output($name, Destination::INLINE);
    }

    public function __toString(): string
    {
        return $this->mpdf->Output('', Destination::STRING_RETURN);
    }
}