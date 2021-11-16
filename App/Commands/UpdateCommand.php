<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Interface\BaseCommandInterface;
use App\Store\StoreManager;

class UpdateCommand implements BaseCommandInterface
{

    public function __construct(InputConsole $input, OutputConsole $output, StoreManager $store)
    {
    }

    public function run()
    {
        // TODO: Implement run() method.
    }
}