<?php

namespace App\Domain\Communication;

use DateTimeImmutable;
use App\Domain\Communication\ValueObject\Contact;
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
     * @return bool
     */
    public function outgoing(): bool;

    /**
     * @return bool
     */
    public function incoming(): bool;

    /**
     * @return DateTimeImmutable
     */
    public function date(): DateTimeImmutable;
}