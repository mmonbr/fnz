<?php

namespace App\Domain\Communication;

use JsonSerializable;

final class Contact implements JsonSerializable
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $number;

    /**
     * Contact constructor.
     * @param string $name
     * @param int $number
     */
    public function __construct(string $name, int $number)
    {
        $this->name = $name;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function number(): int
    {
        return $this->number;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'name'   => $this->name(),
            'number' => $this->number(),
        ];
    }
}