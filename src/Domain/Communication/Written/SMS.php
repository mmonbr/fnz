<?php

namespace App\Domain\Communication\Written;

use DateTimeImmutable;
use App\Domain\Communication\Contact;
use App\Domain\Communication\WrittenCommunication;
use App\Domain\Communication\ValueObject\PhoneNumber;

abstract class SMS implements WrittenCommunication
{
    /**
     * @var PhoneNumber
     */
    private $origin;
    /**
     * @var PhoneNumber
     */
    private $destination;
    /**
     * @var Contact
     */
    private $contact;
    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * SMS constructor.
     * @param PhoneNumber $origin
     * @param PhoneNumber $destination
     * @param Contact $contact
     * @param DateTimeImmutable $date
     */
    public function __construct(PhoneNumber $origin, PhoneNumber $destination, Contact $contact, DateTimeImmutable $date)
    {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->contact = $contact;
        $this->date = $date;
    }

    /**
     * @return PhoneNumber
     */
    public function origin(): PhoneNumber
    {
        return $this->origin;
    }

    /**
     * @return PhoneNumber
     */
    public function destination(): PhoneNumber
    {
        return $this->destination;
    }

    /**
     * @return Contact
     */
    public function contact(): Contact
    {
        return $this->contact;
    }

    /**
     * @return DateTimeImmutable
     */
    public function date(): DateTimeImmutable
    {
        return $this->date;
    }
}