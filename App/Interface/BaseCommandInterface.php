<?php

namespace App\Interface;


use App\Console\InputConsole;
use App\Console\InputValidator;
use App\Console\OutputConsole;
use App\Model\Fast;
use App\Store\StoreManager;

interface BaseCommandInterface
{
    /**
     * @param InputConsole $input
     * @param OutputConsole $output
     * @param StoreManager $store
     * @param InputValidator $validator
     * @param Fast $newFast
     */
    public function __construct(
        InputConsole   $input,
        OutputConsole  $output,
        StoreManager   $store,
        InputValidator $validator,
        Fast           $newFast
    );

    public function run();

}