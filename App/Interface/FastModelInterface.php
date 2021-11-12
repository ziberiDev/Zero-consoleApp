<?php

namespace App\Interface;

interface FastModelInterface
{
    public function __construct(
        string $status,
        string $start,
        string $end,
        string $elapsedTime,
        bool   $type
    );
}