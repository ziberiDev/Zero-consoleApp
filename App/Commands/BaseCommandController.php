<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\InputValidator;
use App\Console\OutputConsole;
use App\Enums\FastType;
use App\Model\Fast;
use App\Store\StoreManager;
use Exception;

class BaseCommandController
{

    protected array $fastTypes;
    protected array $confirmationOptions = [
        "Y" => true,
        "N" => false
    ];

    public function __construct(
        protected InputConsole   $input,
        protected OutputConsole  $output,
        protected StoreManager   $store,
        protected InputValidator $validator,
        protected Fast           $newFast
    ){
        $this->setFastTypes();
    }

    /**
     * Sets fast starting date from user input.
     * @throws Exception
     */
    protected function getStartDate()
    {
        $this->output->write('Enter Start Date of Fast format:(Y-m-d H:i:s) => (2020-10-10 20:00:00)', 'yellow');
        $userInput = $this->input->getInput();

        while ($message = $this->validator->validateStartDate($userInput)) {
            $this->output->write($message, 'red');
            $userInput = $this->input->getInput();
        }
        $this->newFast->set([
            'start' => $userInput
        ]);
    }

    /**
     * Prints fast types in console and sets fast type from user input.
     * @throws Exception
     */
    protected function getFastType()
    {
        $this->output->write('Select a fast type', 'yellow');
        $this->printFastTypes();
        $userInput = $this->input->getInput();

        while (!isset($this->fastTypes[$userInput])) {
            $this->output->write('Please choose from existing types.', 'red');
            $userInput = $this->input->getInput();
        }
        $this->newFast->set([
            'type' => $this->fastTypes[$userInput]['value']
        ]);
    }

    /**
     * Sets $fastTypes property as array from FastType enum class
     */
    protected function setFastTypes()
    {
        foreach (FastType::getAll() as $const => $value) {
            $this->fastTypes[] = [
                'const' => $const,
                'value' => $value
            ];
        }
    }

    /**
     * Prints Fast types from fastTypes property.
     */
    protected function printFastTypes()
    {
        foreach ($this->fastTypes as $key => $value) {
            $this->output->write("[$key] " . $value['const'] . " ({$value['value']}" . 'h)', 'yellow');
        }
    }

    /**
     * Sets the newly created fast  end Date
     */
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

    /**
     * Saves the newly created fast into the store file.
     */
    protected function saveFast()
    {
        $storeFasts = $this->store->getAll()->toArray();

        $storeFasts[] = $this->newFast;

        $this->store->write($storeFasts);
    }

    /**
     * Saves a single Fast object passed as a parameter in the store file.
     * @param Fast $fast
     * @throws Exception
     */
    protected function save(Fast $fast)
    {
        $storeFasts = $this->store->getAll()->toArray();
        $storeFasts[] = $fast;
        $this->store->write($storeFasts);
    }

    protected function askForConfirmation(string $question): string
    {
        $this->output->write($question, 'yellow');
        $this->printConfirmationMenu();
        return strtoupper($this->input->getInput());
    }

    private function printConfirmationMenu()
    {
        foreach ($this->confirmationOptions as $key => $value) {
            $this->output->write("[$key]", 'yellow');
        }
    }
}