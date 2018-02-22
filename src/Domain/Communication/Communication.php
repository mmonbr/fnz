<?php

namespace App\Domain\Communication;

use JsonSerializable;

interface Communication extends JsonSerializable
{
    /**
     * @return int
     */
    public function origin(): int;

    /**
     * @return int
     */
    public function destination(): int;

    /**
     * @return bool
     */
    public function outgoing(): bool;

    /**
     * @return bool
     */
    public function incoming(): bool;
}