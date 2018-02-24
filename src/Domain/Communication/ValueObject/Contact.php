<?php

namespace App\Domain\Communication\ValueObject;

final class Contact
{
    /**
     * @var PhoneNumber
     */
    private $name;
    /**
     * @var int
     */
    private $number;

    /**
     * Contact constructor.
     * @param string $name
     * @param PhoneNumber $number
     */
    public function __construct(string $name, PhoneNumber $number)
    {
        $this->name = $name;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return PhoneNumber
     */
    public function number(): PhoneNumber
    {
        return $this->number;
    }
}