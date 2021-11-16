<?php

namespace App\Enums;

enum FastCategory
{
    case  SHORT;
    case  INTERMEDIATE;
    case  MEDIUM;
    case  LONG;


    public function hours()
    {
        return match ($this) {
            FastCategory::SHORT => 12,
            FastCategory::INTERMEDIATE => 16,
            FastCategory::MEDIUM => 20,
            FastCategory::LONG => 32
        };

    }

}