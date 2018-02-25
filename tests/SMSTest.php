<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Domain\Communication\Written\SMS;
use App\Domain\Communication\Contact\Contact;
use App\Domain\Communication\Written\OutgoingSMS;
use App\Domain\Communication\Written\IncomingSMS;
use App\Domain\Communication\WrittenCommunication;
use App\Domain\Communication\ValueObject\PhoneNumber;

class SMSTest extends TestCase
{
    public function test_an_incoming_sms_can_be_instantiated()
    {
        $contact = new Contact('Manuel');

        $sms = new IncomingSMS(
            new PhoneNumber(600000000),
            new PhoneNumber(700000000),
            $contact,
            new DateTimeImmutable()
        );

        $this->assertInstanceOf(SMS::class, $sms);
        $this->assertInstanceOf(WrittenCommunication::class, $sms);
    }

    public function test_an_outgoing_sms_can_be_instantiated()
    {
        $contact = new Contact('Manuel');

        $sms = new OutgoingSMS(
            new PhoneNumber(600000000),
            new PhoneNumber(700000000),
            $contact,
            new DateTimeImmutable()
        );

        $this->assertInstanceOf(SMS::class, $sms);
        $this->assertInstanceOf(WrittenCommunication::class, $sms);
    }
}