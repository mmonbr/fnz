<?php

namespace App\Domain\Communication;

use DateTimeImmutable;
use App\Domain\Communication\ValueObject\Contact;
use App\Domain\Communication\ValueObject\PhoneNumber;

final class Call implements VoiceCommunication
{
    /**
     * @var PhoneNumber
     */
    private $origin;
    /**
     * @var string
     */
    private $direction;
    /**
     * @var Contact
     */
    private $contact;
    /**
     * @var DateTimeImmutable
     */
    private $date;
    /**
     * @var int
     */
    private $duration;

    /**
     * Call constructor.
     * @param PhoneNumber $origin
     * @param int $direction
     * @param Contact $contact
     * @param DateTimeImmutable $date
     * @param int $duration
     */
    public function __construct(PhoneNumber $origin, int $direction, Contact $contact, DateTimeImmutable $date, int $duration)
    {
        $this->origin = $origin;
        $this->direction = $direction;
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
     * @return string
     */
    public function direction(): string
    {
        if (true === $this->outgoing()) {
            return 'outgoing';
        }

        return 'incoming';
    }

    /**
     * @return bool
     */
    public function outgoing(): bool
    {
        return $this->direction === 0;
    }

    /**
     * @return bool
     */
    public function incoming(): bool
    {
        return $this->direction === 1;
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