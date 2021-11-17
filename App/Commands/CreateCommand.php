<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\InputValidator;
use App\Console\OutputConsole;
use App\Enums\FastType;
use App\Interface\BaseCommandInterface;
use App\Model\Fast;
use App\Store\StoreManager;
use JetBrains\PhpStorm\Pure;

class CreateCommand implements BaseCommandInterface
{
    protected InputValidator $validator;
    protected Fast $newFast;
    protected array $fastTypes;

    #[Pure] public function __construct(
        protected InputConsole  $input,
        protected OutputConsole $output,
        protected StoreManager  $store
    )
    {
        //TODO : Inject validator
        $this->validator = new InputValidator();
        $this->newFast = new Fast();
        $this->setFastTypes();

    }

    public function run()
    {
        $this->getStartDate();
        $this->getFastType();
        $this->setFastEndDate();
        $this->saveFast();
    }

    protected function getStartDate()
    {
        $this->output->write('Enter Start Date of Fast format:(Y-m-d H:i:s) => (2020-10-10 20:00:00)');
        $userInput = $this->input->getInput();

        if ($message = $this->validator->validateStartdate($userInput)) {
            $this->output->write($message);
            $this->getStartDate();
        }
        $this->newFast->set([
            'start' => $userInput
        ]);
    }

    protected function getFastType()
    {
        $this->output->write('Select a fast type');
        $this->printFastTypes();
        $userInput = $this->input->getInput();
        if (!key_exists($userInput, $this->fastTypes)) {
            $this->output->write('Please choose from existing types.');
            $this->getFastType();
        }
        $this->newFast->set([
            'type' => $this->fastTypes[$userInput]['value']
        ]);
        return;
    }

    protected function setFastTypes()
    {
        foreach (FastType::getAll() as $const => $value) {
            $this->fastTypes[] = [
                'const' => $const,
                'value' => $value
            ];
        }
    }

    protected function printFastTypes()
    {
        foreach ($this->fastTypes as $key => $value) {
            $this->output->write("[$key] " . $value['const'] . " ({$value['value']}" . 'h)');
        }
    }

    protected function setFastEndDate()
    {
        $hours = 'PT' . $this->newFast->type . 'H';
        $fastEndDate = $this->newFast
            ->start
            ->add(new \DateInterval("$hours"))
            ->format('Y-m-d H:i:s');

        $this->newFast->set([
            'end' => $fastEndDate
        ]);
    }

    protected function saveFast()
    {
        $storeFasts = $this->store->getAll()->toArray();

        $storeFasts[] = $this->newFast;

        $this->store->write($storeFasts);
    }
}