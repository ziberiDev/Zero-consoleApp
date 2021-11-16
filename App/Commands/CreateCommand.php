<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\InputValidator;
use App\Console\OutputConsole;
use App\Interface\BaseCommandInterface;
use App\Model\Fast;
use App\Store\StoreManager;

class CreateCommand implements BaseCommandInterface
{
    protected InputValidator $validator;
    protected Fast $newFast;

    public function __construct(
        protected InputConsole  $input,
        protected OutputConsole $output,
        protected StoreManager  $store
    )
    {
        //TODO : Inject validator
        $this->validator = new InputValidator();
        $this->newFast = new Fast();

    }

    public function run()
    {
        $this->getStartDate();
        $this->getFastType();
    }

    protected function getStartDate()
    {
        $this->output->write('Enter Start Date of Fast format:(Y-m-d H:i:s) => (2020-10-10 20:00:00)');
        $userInput = $this->input->getInput();

        if ($message = $this->validator->validateStartdate($userInput)) {
            $this->output->write($message);
            $this->getStartDate();
        }
        $this->output->write($userInput);
    }

    protected function getFastType()
    {
        $this->output->write('Select a fast type');
        $userInput = $this->input->getInput();
        $this->output->write($userInput);
    }


}