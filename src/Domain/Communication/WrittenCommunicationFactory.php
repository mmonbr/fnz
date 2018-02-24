<?php

namespace App\Domain\Communication;

interface WrittenCommunicationFactory
{
    /**
     * @param string $origin
     * @param string $destination
     * @param int $direction
     * @param string $contactName
     * @param string $date
     * @return WrittenCommunication
     */
    public function create(string $origin, string $destination, int $direction, string $contactName, string $date): WrittenCommunication;
}