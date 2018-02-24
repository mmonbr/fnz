<?php

namespace App\Domain\Communication\Exception;

use Exception;

class InvalidPhoneNumber extends Exception
{
    /**
     * @param string $number
     * @return InvalidPhoneNumber
     */
    public static function forNumber(string $number): self
    {
        return new self(
            "Invalid phone number: {$number}"
        );
    }
}