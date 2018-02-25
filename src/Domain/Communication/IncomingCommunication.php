<?php

namespace App\Domain\Communication;

trait IncomingCommunication
{
    /**
     * @return string
     */
    public function direction(): string
    {
        return 'incoming';
    }
}