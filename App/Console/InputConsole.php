<?php

namespace App\Console;

use App\Model\Fast;

class InputConsole
{
    /**
     * Returns trimmed input from console
     * @return string
     */
    public function getInput(): string
    {
        return trim(fgets(STDIN));
    }
}