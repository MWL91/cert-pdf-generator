<?php

namespace Lenkowski\Cert\Abstract;

use Lenkowski\Cert\Certificate;

interface CertificatePrinter
{
    public function printCertificate(Certificate $cert): void;
}