<?php

namespace App\Domain\Communication\Written;

use App\Domain\Communication\IncomingCommunication;

final class IncomingSMS extends SMS
{
    use IncomingCommunication;
}