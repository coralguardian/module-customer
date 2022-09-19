<?php

namespace D4rk0snet\Coralguardian\Enums;

enum CustomerType : string
{
    case INDIVIDUAL = 'individual';
    case COMPANY = 'company';

    public function getFiscalReduction() : string
    {
        return match($this) {
            self::INDIVIDUAL => 66,
            self::COMPANY => 60
        };
    }
}
