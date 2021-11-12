<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Interface\BaseCommandInterface;

class CreateCommand implements BaseCommandInterface
{

    public function __construct(protected InputConsole $input, protected OutputConsole $output)
    {
    }

    public function run()
    {
        $this->getStartDate();

        $this->getFastType();

    }

    protected function getStartDate()
    {
        $this->output->write('Enter Start Date of Fast');

        $userInput = $this->input->getInput();

        $this->output->write($userInput);
    }

    protected function getFastType()
    {
        $this->output->write('Select a fast type');

        $userInput = $this->input->getInput();

        $this->output->write($userInput);
    }
}