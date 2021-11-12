<?php

namespace App\Model;

use App\Interface\FastModelInterface;

class FastModel implements FastModelInterface
{

    public function __construct(
        public string      $status,
        public string      $start,
        public string      $end,
        public bool|string $type,
        public string|bool $elapsedTime = "0"
    )
    {
    }
}