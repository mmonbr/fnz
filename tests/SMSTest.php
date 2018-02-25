<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Domain\Communication\Written;
use App\Domain\Communication\ValueObject\Contact;
use App\Domain\Communication\ValueObject\PhoneNumber;

class SMSTest extends TestCase
{
    public function test_a_sms_can_be_instantiated()
    {
        $contact = new Contact('Manuel', new PhoneNumber(700000000));

        $sms = new SMS(
            new PhoneNumber(600000000),
            0,
            $contact,
            new DateTimeImmutable()

        );

        $this->assertInstanceOf(SMS::class, $sms);
    }
}