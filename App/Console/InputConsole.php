<?php

namespace App\Console;

use App\Model\Fast;

class InputConsole
{

    public function getInput()
    {
        return trim(fgets(STDIN), "\n\r");
    }


}