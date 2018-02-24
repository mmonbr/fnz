<?php

namespace App\Tests;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use App\Domain\Communication\Call;
use App\Domain\Communication\Contact;

class CallTest extends TestCase
{
    /**
     * @test
     */
    public function test_a_call_can_be_instantiated()
    {
        $contact = new Contact('Manuel', 7000000);

        $call = new Call(
            600000000,
            0,
            $contact,
            new DateTimeImmutable(),
            60
        );
    }
}