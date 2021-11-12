<?php

use App\Commands\CommandController;
use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Store\StoreManager;

require_once './vendor/autoload.php';


//$fast = new \App\Model\Fast(1, '2021-10-11 10:22:00', date('Y-m-d H:m:s'));

$commands = new CommandController(
    new InputConsole(),
    new OutputConsole(),
    new StoreManager());

$commands->run();


