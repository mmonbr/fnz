<?php

namespace App\Domain\Communication\Spoken;

use App\Domain\Communication\IncomingCommunication;

final class IncomingPhoneCall extends PhoneCall
{
    use IncomingCommunication;
}