<?php

namespace App\Domain\Communication;

trait OutgoingCommunication
{
    /**
     * @return string
     */
    public function direction(): string
    {
        return 'outgoing';
    }
}