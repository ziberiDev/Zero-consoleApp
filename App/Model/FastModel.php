<?php

namespace App\Model;

use App\Enums\FastCategory;
use App\Interface\FastModelInterface;

class FastModel implements FastModelInterface
{

    public function __construct(
        public string       $status,
        public string       $start,
        public string       $end,
        public FastCategory $type,
        public string|bool  $elapsedTime = "0"
    )
    {

    }
}