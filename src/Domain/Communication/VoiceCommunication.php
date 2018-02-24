<?php

namespace App\Domain\Communication;

interface VoiceCommunication extends Communication
{
    /**
     * @return int
     */
    public function duration() : int;
}