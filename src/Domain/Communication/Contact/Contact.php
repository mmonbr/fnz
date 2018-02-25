<?php

namespace App\Domain\Communication\Contact;

use App\Domain\Communication\Contact as ContactInterface;

final class Contact implements ContactInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * Contact constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}