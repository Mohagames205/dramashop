<?php

namespace App\Enums;

enum Status: int
{

    case RESERVED = 0;
    case PROCESSING = 1;
    case SENT = 2;
    case DONE = 3;

    public function readable(): string {
        return match ($this) {
            Status::RESERVED => "Gereserveerd",
            Status::PROCESSING => "In behandeling",
            Status::SENT => "Verzonden",
            Status::DONE => "Ontvangen"
        };
    }


}
