<?php

namespace App\Domain\Communication;

use ArrayIterator;

final class Communications implements CommunicationCollection
{
    /**
     * @var Communication[]
     */
    private $communications;

    /**
     * Communications constructor.
     * @param Communication[] ...$communications
     */
    public function __construct(Communication ...$communications)
    {
        $this->communications = $communications;
    }

    /**
     * @return CommunicationCollection
     */
    public function all(): CommunicationCollection
    {
        return new self(... $this->communications);
    }

    /**
     * @return CommunicationCollection
     */
    public function calls(): CommunicationCollection
    {
        $communications = array_filter($this->communications, function (Communication $communication) {
            return $communication instanceof Call;
        });

        return new self(... $communications);
    }

    /**
     * @return CommunicationCollection
     */
    public function sms(): CommunicationCollection
    {
        $communications = array_filter($this->communications, function (Communication $communication) {
            return $communication instanceof SMS;
        });

        return new self(... $communications);
    }

    /**
     * @param null|string $type
     * @return CommunicationCollection
     */
    public function byType(?string $type): CommunicationCollection
    {
        switch ($type) {
            case 'sms' :
                $communications = $this->sms();
                break;
            case 'call':
                $communications = $this->calls();
                break;
            default:
                $communications = $this->all();
        }

        return new self(... $communications);
    }


    /**
     * @param Communication $communication
     * @return CommunicationCollection
     */
    public function add(Communication $communication): CommunicationCollection
    {
        $this->communications[] = $communication;

        return new self(... $this->communications);
    }

    /**
     * @param int $number
     * @return CommunicationCollection
     */
    public function containingNumber(int $number): CommunicationCollection
    {
        $communications = array_filter($this->communications, function (Communication $communication) use ($number) {
            return $communication->origin()->number() === $number || $communication->destination()->number() === $number;
        });

        return new self(... $communications);
    }

    /**
     * @param int $number
     * @return CommunicationCollection
     */
    public function originIs(int $number): CommunicationCollection
    {
        $communications = array_filter($this->communications, function (Communication $communication) use ($number) {
            return $communication->origin() === $number;
        });

        return new self(... $communications);
    }

    /**
     * @param int $number
     * @return CommunicationCollection
     */
    public function destinationIs(int $number): CommunicationCollection
    {
        $communications = array_filter($this->communications, function (Communication $communication) use ($number) {
            return $communication->destination() === $number;
        });

        return new self(... $communications);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->communications;
    }

    /**
     * @inheritdoc
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->communications);
    }

    /**
     * @inheritdoc
     */
    public function count(): int
    {
        return count($this->getIterator());
    }
}