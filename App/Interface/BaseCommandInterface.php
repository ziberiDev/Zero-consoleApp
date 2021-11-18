<?php

namespace App\Interface;


use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Store\StoreManager;

interface BaseCommandInterface
{
    /**
     * @param InputConsole $input
     * @param OutputConsole $output
     * @param StoreManager $store
     */
    public function __construct(InputConsole $input, OutputConsole $output, StoreManager $store);

    public function run();

}