<?php

namespace App\Console;

use App\Model\Fast;

class InputConsole
{
    /**
     * @return string
     */
    public function getInput()
    {
        return trim(fgets(STDIN));
    }
}