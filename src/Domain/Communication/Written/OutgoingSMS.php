<?php

namespace App\Domain\Communication\Written;

use App\Domain\Communication\OutgoingCommunication;

final class OutgoingSMS extends SMS
{
    use OutgoingCommunication;
}