<?php

namespace App\Console;


use App\Model\Fast;

class OutputConsole
{

    /**
     * Prints string into the console
     * @param $text
     */
    public function write($text)
    {
        echo $text . "\n\r";
    }


}