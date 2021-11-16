<?php

namespace App\Console;

use App\Enums\FastCategory;
use App\Model\Fast;

class OutputConsole
{

    public function write($text)
    {
        if (\enum_exists(FastCategory::class)) {
            $myclass = FastCategory::LONG->hours();
            echo $myclass;
        }
        echo print_r($text) . "\n\r";
    }

}