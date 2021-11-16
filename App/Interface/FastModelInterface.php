<?php

namespace App\Interface;


interface FastModelInterface
{
    public function __construct(

        string $start,
        int    $status,
        string $end,
        int    $type,
        string $elapsedTime
    );
}