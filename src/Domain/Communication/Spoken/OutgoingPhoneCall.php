<?php

namespace App\Domain\Communication\Spoken;

use App\Domain\Communication\OutgoingCommunication;

final class OutgoingPhoneCall extends PhoneCall
{
    use OutgoingCommunication;
}