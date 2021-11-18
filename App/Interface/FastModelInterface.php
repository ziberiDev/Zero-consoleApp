<?php

namespace App\Interface;


interface FastModelInterface
{
    /**
     * @param string $start
     * @param int $status
     * @param string $end
     * @param int $type
     * @param string $elapsedTime
     */
    public function __construct(

        string $start,
        int    $status,
        string $end,
        int    $type,
        string $elapsedTime
    );
}