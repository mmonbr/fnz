<?php

namespace App\Domain\Communication\Spoken;

use DateTimeImmutable;
use App\Domain\Communication\SpokenCommunication;
use App\Domain\Communication\ValueObject\Contact;
use App\Domain\Communication\ValueObject\PhoneNumber;

abstract class PhoneCall implements SpokenCommunication
{
    /**
     * @var PhoneNumber
     */
    protected $origin;
    /**
     * @var Contact
     */
    protected $contact;
    /**
     * @var DateTimeImmutable
     */
    protected $date;
    /**
     * @var int
     */
    protected $duration;

    /**
     * Call constructor.
     * @param PhoneNumber $origin
     * @param Contact $contact
     * @param DateTimeImmutable $date
     * @param int $duration
     */
    public function __construct(PhoneNumber $origin, Contact $contact, DateTimeImmutable $date, int $duration)
    {
        $this->origin = $origin;
        $this->contact = $contact;
        $this->date = $date;
        $this->duration = $duration;
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
        return $this->contact->number();
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

    /**
     * @return int
     */
    public function duration(): int
    {
        return $this->duration;
    }
}