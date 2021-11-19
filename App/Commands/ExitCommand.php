<?php

namespace App\Commands;

use App\{Console\InputConsole,
    Console\InputValidator,
    Console\OutputConsole,
    Interface\BaseCommandInterface,
    Store\StoreManager,
    Model\Fast
};


class ExitCommand extends BaseCommandController implements BaseCommandInterface
{

    public function __construct(
        protected InputConsole   $input,
        protected OutputConsole  $output,
        protected StoreManager   $store,
        protected InputValidator $validator,
        protected Fast           $newFast
    )
    {
    }

    public function run()
    {
        $userInput = $this->askForConfirmation("Are you sure you want to exit the app?");
        if (!$this->confirmationOptions[$userInput]) return;
        $this->output->writeGreen('See you soon.. Goodbye....');
        exit;
    }
}