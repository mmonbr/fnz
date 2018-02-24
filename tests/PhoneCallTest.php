<?php

namespace App\Tests;

use App\Domain\Communication\ValueObject\Contact;
use App\Domain\Communication\ValueObject\PhoneNumber;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Domain\Communication\PhoneCall;

class PhoneCallTest extends TestCase
{
    public function test_a_call_can_be_instantiated()
    {
        $contact = new Contact('Manuel', new PhoneNumber(700000000));

        $call = new PhoneCall(
            new PhoneNumber(600000000),
            0,
            $contact,
            new DateTimeImmutable(),
            60
        );

        $this->assertInstanceOf(PhoneCall::class, $call);
    }
}