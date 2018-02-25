<?php

namespace App\Tests;

use Countable;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Domain\Communication\Written\SMS;
use App\Domain\Communication\Communications;
use App\Domain\Communication\Contact\Contact;
use App\Domain\Communication\Spoken\PhoneCall;
use App\Domain\Communication\Written\OutgoingSMS;
use App\Domain\Communication\Written\IncomingSMS;
use App\Domain\Communication\CommunicationCollection;
use App\Domain\Communication\ValueObject\PhoneNumber;
use App\Domain\Communication\Spoken\OutgoingPhoneCall;
use App\Domain\Communication\Spoken\IncomingPhoneCall;

class CommunicationsCollectionTest extends TestCase
{
    /** @var CommunicationCollection */
    private $communications;

    public function setUp()
    {
        $this->communications = new Communications();

        $incomingSMS = new IncomingSMS(
            new PhoneNumber(611222333),
            new PhoneNumber(711222333),
            new Contact('Manuel'),
            new DateTimeImmutable()
        );

        $outgoingSMS = new OutgoingSMS(
            new PhoneNumber(644555666),
            new PhoneNumber(744555666),
            new Contact('Manuel'),
            new DateTimeImmutable()
        );

        $incomingCall = new IncomingPhoneCall(
            new PhoneNumber(655666777),
            new PhoneNumber(755666777),
            new Contact('Manuel'),
            new DateTimeImmutable(),
            100
        );

        $outgoingCall = new OutgoingPhoneCall(
            new PhoneNumber(688999000),
            new PhoneNumber(788999000),
            new Contact('Manuel'),
            new DateTimeImmutable(),
            100
        );

        $this->communications->add($incomingSMS);
        $this->communications->add($outgoingSMS);
        $this->communications->add($incomingCall);
        $this->communications->add($outgoingCall);
    }

    public function test_only_sms_are_returned()
    {
        $this->assertContainsOnly(SMS::class, $this->communications->sms());
        $this->assertContainsOnly(SMS::class, $this->communications->byType('sms'));
    }

    public function test_only_phone_calls_are_returned()
    {
        $this->assertContainsOnly(PhoneCall::class, $this->communications->calls());
        $this->assertContainsOnly(PhoneCall::class, $this->communications->byType('call'));
    }

    public function test_immutability()
    {
        $this->assertNotSame($this->communications->sms(), $this->communications->sms());
        $this->assertNotSame($this->communications->calls(), $this->communications->calls());
        $this->assertNotSame($this->communications->all(), $this->communications->all());
    }

    public function test_communications_can_be_filtered_by_number()
    {
        $subset = $this->communications->containingNumber(611222333);

        $this->assertCount(1, $subset);
    }

    public function test_communications_can_be_filtered_by_their_origin() {
        $subset = $this->communications->originIs(611222333);

        $this->assertCount(1, $subset);
    }

    public function test_communications_can_be_filtered_by_their_destination() {
        $subset = $this->communications->destinationIs(711222333);

        $this->assertCount(1, $subset);
    }

    public function test_communications_can_be_counted() {
        $this->assertEquals(4, $this->communications->count());
        $this->assertInstanceOf(Countable::class, $this->communications);
    }
}