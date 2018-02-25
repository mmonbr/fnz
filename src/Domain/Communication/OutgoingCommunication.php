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

    /**
     * @return bool
     */
    public function outgoing(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function incoming(): bool
    {
        return true;
    }
}