<?php

namespace App\Console;

class OutputConsole
{

    public function write($text)
    {
        echo sprintf("%s\n\r", $text);
    }

}