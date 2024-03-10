<?php

use Lenkowski\Cert\Certificate;
use Ramsey\Uuid\Uuid;

describe('Certificate ValueObject', function () {
    $uuid = Uuid::uuid4();
    $cert = new Certificate(
        'Marcin Lenkowski',
        $uuid,
        new \DateTimeImmutable('2021-09-01'),
        'cert.pdf'
    );

    it('should return name', fn() => expect($cert->getName())->toBe('Marcin Lenkowski'));
    it('should return certificate number', fn() => expect($cert->getNumber())->toBe($uuid->toString()));
    it('should return issued at', fn () => expect($cert->getIssuedAt())->toBeInstanceOf(\DateTimeInterface::class));
    it('should return formatted issued at', fn() => expect($cert->printIssuedAt())->toBe('2021-09-01'));
    it('should return issuer', fn () => expect($cert->getIssuer())->toBe(Certificate::ISSUER));
    it('should return template', fn () => expect($cert->getTemplate())->toBe('cert.pdf'));
    it('should return filename', fn () => expect($cert->getFilename())->toBe('Marcin Lenkowski.pdf'));
});
