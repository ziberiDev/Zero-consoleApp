<?php

use App\Commands\CommandController;
use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Model\Fast;
use App\Store\StoreManager;

require_once './vendor/autoload.php';

$obj = new Fast('2020-10-10 10:00:00', 0, '2020-10-11 10:00:00', 12, '');



$commands = new CommandController(
    new InputConsole(),
    new OutputConsole(),
    new StoreManager());

$commands->run();



