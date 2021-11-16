<?php

namespace App\Console;

use App\Model\Fast;

class InputConsole
{

    public function getInput()
    {

        //TODO:refactor

        $stdin = fopen('php://stdin', 'r');


        return trim(fgets($stdin), "\n\r");
    }


}