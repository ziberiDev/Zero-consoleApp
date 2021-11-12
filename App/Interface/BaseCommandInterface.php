<?php

namespace App\Interface;


use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Store\StoreManager;

interface BaseCommandInterface
{

    public function __construct(InputConsole $input, OutputConsole $output , StoreManager  $store);

    public function run();

}