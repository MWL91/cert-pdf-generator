<?php

namespace Lenkowski\Cert\Abstract;

use Lenkowski\Cert\Implementation\Printers\PdfDestination;

interface PdfPrinter
{
    public function setAuthor(string $author): void;

    public function setSourcePdf(string $path): void;

    public function writeHtml(string $html): void;

    public function print(string $name = ''): void;

    public function __toString(): string;
}