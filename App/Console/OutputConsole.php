<?php

namespace App\Console;


use App\Model\Fast;

class OutputConsole
{
    protected array $colors = [
        'white' => "[1;37m",
        'yellow' => "[33;1m",
        'green' => "[32;1m",
        'red' => "[41;1m"
    ];

    /**
     * Echos passed string into console as  text
     * @param $text
     * @param string $color
     * color options (white{default} , yellow , green , red{outputs white text with red background})
     */
    public function write($text, string $color = 'white')
    {
        $outputColor = $this->colors["$color"] ?? "[1;37m";
        echo "\e" . $outputColor . $text . "\e[0m" . "\n\r";
    }
}