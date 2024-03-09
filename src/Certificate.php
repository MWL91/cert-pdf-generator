<?php

namespace Lenkowski\Cert;

use Ramsey\Uuid\UuidInterface;

final class Certificate
{
    public const ISSUER = 'Lenkowski.net';

    public function __construct(
        private string $name,
        private UuidInterface $number,
        private \DateTimeInterface $issued_at
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumber(): string
    {
        return $this->getUuid()->toString();
    }

    public function getUuid(): UuidInterface
    {
        return $this->number;
    }

    public function getIssuedAt(): \DateTimeInterface
    {
        return $this->issued_at;
    }

    public function printIssuedAt(): string
    {
        return $this->issued_at->format('Y-m-d');
    }

    public function getIssuer(): string
    {
        return self::ISSUER;
    }
}