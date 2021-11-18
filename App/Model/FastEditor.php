<?php

namespace App\Model;

use App\Console\InputConsole;
use App\Console\InputValidator;
use App\Console\OutputConsole;
use App\Enums\FastType;
use App\Store\StoreManager;

class FastEditor
{

    protected InputValidator $validator;
    protected Fast $newFast;
    protected array $fastTypes;

    public function __construct(
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

    protected function getStartDate()
    {
        $this->output->write('Enter Start Date of Fast format:(Y-m-d H:i:s) => (2020-10-10 20:00:00)');
        $userInput = $this->input->getInput();

        while ($message = $this->validator->validateStartdate($userInput)) {
            $this->output->write($message);
            $userInput = $this->input->getInput();
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

        while (!key_exists($userInput, $this->fastTypes)) {
            $this->output->write('Please choose from existing types.');

            $userInput = $this->input->getInput();
        }
        $this->newFast->set([
            'type' => $this->fastTypes[$userInput]['value']
        ]);
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

    /**
     * @param Fast $fast
     */
    protected function save(Fast $fast)
    {
        $storeFasts = $this->store->getAll()->toArray();

        $storeFasts[] = $fast;

        $this->store->write($storeFasts);
    }
}