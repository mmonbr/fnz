<?php

namespace App\Tests;

use App\Domain\Communication\Exception\InvalidPhoneNumber;
use App\Domain\Communication\ValueObject\PhoneNumber;
use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{
    public function test_a_number_must_be_valid()
    {
        $this->expectException(InvalidPhoneNumber::class);

        new PhoneNumber(0);
    }
}