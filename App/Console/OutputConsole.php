<?php

namespace App\Console;


use App\Model\Fast;

class OutputConsole
{

    public function write($text)
    {

        echo $text . "\n\r";
    }

}