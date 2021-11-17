<?php

use App\Commands\CommandController;
use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Model\Fast;
use App\Store\StoreManager;

require_once './vendor/autoload.php';

$commands = new CommandController(
    new InputConsole(),
    new OutputConsole(),
    new StoreManager()
);

$commands->run();



