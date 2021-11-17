<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Interface\BaseCommandInterface;
use App\Store\StoreManager;

class ExitCommand implements BaseCommandInterface
{

    public function __construct(
        protected InputConsole  $input,
        protected OutputConsole $output,
        protected StoreManager  $store)
    {
    }

    public function run()
    {
        exit;
    }
}