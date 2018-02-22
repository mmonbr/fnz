<?php

namespace App\Domain\Communication;

use Countable;
use IteratorAggregate;

interface CommunicationCollection extends IteratorAggregate, Countable
{
    /**
     * @param Communication $communication
     * @return CommunicationCollection
     */
    public function add(Communication $communication): CommunicationCollection;

    /**
     * @return CommunicationCollection
     */
    public function all() : CommunicationCollection;

    /**
     * @return CommunicationCollection
     */
    public function calls(): CommunicationCollection;

    /**
     * @return CommunicationCollection
     */
    public function sms(): CommunicationCollection;

    /**
     * @param int $number
     * @return CommunicationCollection
     */
    public function containingNumber(int $number) : CommunicationCollection;

    /**
     * @param int $number
     * @return CommunicationCollection
     */
    public function originIs(int $number) : CommunicationCollection;

    /**
     * @param int $number
     * @return CommunicationCollection
     */
    public function destinationIs(int $number) : CommunicationCollection;

    /**
     * @return array
     */
    public function toArray() : array;
}