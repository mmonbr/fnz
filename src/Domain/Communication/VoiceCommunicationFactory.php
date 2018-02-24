<?php

namespace App\Domain\Communication;

interface VoiceCommunicationFactory
{
    /**
     * @param string $origin
     * @param string $destination
     * @param int $direction
     * @param string $contactName
     * @param string $date
     * @param int $duration
     * @return VoiceCommunication
     */
    public function create(string $origin, string $destination, int $direction, string $contactName, string $date, int $duration): VoiceCommunication;
}