<?php

namespace App\Domain\Communication\ValueObject;

use App\Domain\Communication\Exception\InvalidPhoneNumber;

final class PhoneNumber
{
    /**
     * @var int
     */
    private $number;

    /**
     * PhoneNumber constructor.
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->assertNumberIsValid($number);

        $this->number = $number;
    }

    /**
     * @param string $number
     * @throws InvalidPhoneNumber
     */
    private function assertNumberIsValid(string $number)
    {
        $expression = '/^(\+34|0034|34)?[\s|\-|\.]?(([\d]{3,4})|([6|7|9][\s|\-|\.]?([0-9][\s|\-|\.]?){8}))$/';

        if (0 === preg_match($expression, $number)) {
            throw InvalidPhoneNumber::forNumber($number);
        }
    }

    /**
     * @return int
     */
    public function number(): int
    {
        return $this->number;
    }
}