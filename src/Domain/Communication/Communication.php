<?php

namespace App\Domain\Communication;

use DateTimeImmutable;
use App\Domain\Communication\ValueObject\PhoneNumber;

interface Communication
{
    /**
     * @return PhoneNumber
     */
    public function origin(): PhoneNumber;

    /**
     * @return PhoneNumber
     */
    public function destination(): PhoneNumber;

    /**
     * @return Contact
     */
    public function contact(): Contact;

    /**
     * @return string
     */
    public function direction(): string;

    /**
     * @return DateTimeImmutable
     */
    public function date(): DateTimeImmutable;
}