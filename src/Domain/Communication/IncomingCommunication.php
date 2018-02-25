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