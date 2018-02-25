<?php

namespace App\Domain\Communication;

interface SpokenCommunication extends Communication
{
    /**
     * @return int
     */
    public function duration() : int;
}