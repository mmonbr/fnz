<?php

namespace App\Domain\Communication;

interface CommunicationRepository
{
    /**
     * @param int $phoneNumber
     * @return CommunicationCollection
     */
    public function findByPhoneNumber(int $phoneNumber): CommunicationCollection;
}