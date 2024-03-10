<?php

use Lenkowski\Cert\Certificate;
use Lenkowski\Cert\Implementation\CertificatePrinter;
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

    it('should not allow empty name', fn() =>
        expect(fn() => new Certificate(
            '',
            $uuid,
            new \DateTimeImmutable('2021-09-01'),
            'cert.pdf'
        ))->toThrow(InvalidArgumentException::class)
    );

    it('should not allow empty template', fn() =>
        expect(fn() => new Certificate(
            'Marcin Lenkowski',
            $uuid,
            new \DateTimeImmutable('2021-09-01'),
            ''
        ))->toThrow(InvalidArgumentException::class)
    );

    it('should not allow for future certificates', fn() =>
        expect(fn() => new Certificate(
            'Marcin Lenkowski',
            $uuid,
            new \DateTimeImmutable('+1 day'),
            'cert.pdf'
        ))->toThrow(OutOfRangeException::class)
    );

    it('should not destroy HTML structure', function () {
        $cert = new Certificate(
            '<b>Marcin</b> <span>Lenkowski</span>',
            Uuid::uuid4(),
            new \DateTimeImmutable('2021-09-01'),
            'cert.pdf'
        );

        expect($cert->getName())->toBe('Marcin Lenkowski');
    });

});
