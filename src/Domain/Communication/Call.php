<?php

namespace App\Domain\Communication;

use DateTimeImmutable;

final class Call implements Communication
{
    /**
     * @var int
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
     * @param int $origin
     * @param int $direction
     * @param Contact $contact
     * @param DateTimeImmutable $date
     * @param int $duration
     */
    public function __construct(int $origin, int $direction, Contact $contact, DateTimeImmutable $date, int $duration)
    {
        $this->origin = $origin;
        $this->direction = $direction;
        $this->contact = $contact;
        $this->date = $date;
        $this->duration = $duration;
    }

    /**
     * @return int
     */
    public function origin(): int
    {
        return $this->origin;
    }

    /**
     * @return int
     */
    public function destination(): int
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

    /**
     * @inheritdoc
     */
    public function jsonSerialize(): array
    {
        return [
            'type'      => 'call',
            'origin'    => $this->origin(),
            'direction' => $this->direction(),
            'date'      => $this->date(),
            'contact'   => [
                'name'   => $this->contact->name(),
                'number' => $this->contact->number(),
            ],
            'duration'  => $this->duration()
        ];
    }
}