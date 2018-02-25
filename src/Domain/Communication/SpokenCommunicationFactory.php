<?php

namespace App\Domain\Communication;

interface SpokenCommunicationFactory
{
    /**
     * @param string $origin
     * @param string $destination
     * @param int $direction
     * @param string $contactName
     * @param string $date
     * @param int $duration
     * @return SpokenCommunication
     */
    public function create(string $origin, string $destination, int $direction, string $contactName, string $date, int $duration): SpokenCommunication;
}