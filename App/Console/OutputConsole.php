<?php

namespace App\Console;


use App\Model\Fast;

class OutputConsole
{

    /**
     *
     * Echos passed string into console as white text
     * @param $text
     */
    public function write($text)
    {
        echo $text . "\n\r";
    }

    /**
     * Echos passed string into console as yellow text
     * @param $text
     */
    public function writeYellow($text)
    {
        echo "\e[33;1m" . $text . "\e[0m" . "\n\r";
    }

    /**
     * Echos passed string into console as green text
     * @param $text
     */
    public function writeGreen($text)
    {
        echo "\e[32;1m" . $text . "\e[0m" . "\n\r";
    }

    /**
     * Echos passed string into console with red background text
     * @param $text
     */
    public function writeError($text)
    {
        echo "\e[41;1m" . $text . "\e[0m" . "\n\r";
    }


}