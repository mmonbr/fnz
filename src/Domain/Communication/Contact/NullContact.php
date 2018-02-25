<?php

namespace App\Domain\Communication\Contact;

use App\Domain\Communication\Contact;

final class NullContact implements Contact
{
    /**
     * @return string
     */
    public function name(): string
    {
        return 'Unknown';
    }
}