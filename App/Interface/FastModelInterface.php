<?php

namespace App\Interface;

use App\Enums\FastCategory;


interface FastModelInterface
{
    public function __construct(
        string       $status,
        string       $start,
        string       $end,
        FastCategory $type,
        string       $elapsedTime
    );
}