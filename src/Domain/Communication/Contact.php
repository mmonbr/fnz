<?php

namespace App\Domain\Communication;

interface Contact
{
    /**
     * @return string
     */
    public function name(): string;
}