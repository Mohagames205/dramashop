<?php

namespace App\Enums;

enum LogAction: int
{

    case CREATED_RESERVATION = 0;
    case DELETED_RESERVATION = 1;


    public function readable(): string {
        return match ($this) {
            LogAction::CREATED_RESERVATION => "Reservatie aangemaakt",
            LogAction::DELETED_RESERVATION => "Reservatie verwijderd",
        };
    }


}
