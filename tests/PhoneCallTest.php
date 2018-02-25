<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Domain\Communication\Contact\Contact;
use App\Domain\Communication\Spoken\PhoneCall;
use App\Domain\Communication\SpokenCommunication;
use App\Domain\Communication\ValueObject\PhoneNumber;
use App\Domain\Communication\Spoken\OutgoingPhoneCall;
use App\Domain\Communication\Spoken\IncomingPhoneCall;

class PhoneCallTest extends TestCase
{
    public function test_an_incoming_call_can_be_instantiated()
    {
        $contact = new Contact('Manuel');

        $call = new IncomingPhoneCall(
            new PhoneNumber(600000000),
            new PhoneNumber(700000000),
            $contact,
            new DateTimeImmutable(),
            60
        );

        $this->assertInstanceOf(PhoneCall::class, $call);
        $this->assertInstanceOf(SpokenCommunication::class, $call);
    }

    public function test_an_outgoing_call_can_be_instantiated()
    {
        $contact = new Contact('Manuel');

        $call = new OutgoingPhoneCall(
            new PhoneNumber(600000000),
            new PhoneNumber(700000000),
            $contact,
            new DateTimeImmutable(),
            60
        );

        $this->assertInstanceOf(PhoneCall::class, $call);
        $this->assertInstanceOf(SpokenCommunication::class, $call);
    }
}