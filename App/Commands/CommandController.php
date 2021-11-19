<?php

namespace App\Commands;

use App\Console\{InputConsole, InputValidator, OutputConsole};
use App\Interface\{BaseCommandInterface , FileManagerInterface};
use App\Model\Fast;


class CommandController implements BaseCommandInterface
{

    public bool $appRunning = true;

    protected bool $activeFasts = false;

    protected bool $canCreate = false;

    protected bool $noCondition = true;

    protected array $availableCommands = [];

    private array $menu = [
        [
            'option' => 'Check the fast status',
            'command' => CheckCommand::class,
            'condition' => 'noCondition'
        ],
        [
            'option' => 'Create Fast',
            'command' => CreateCommand::class,
            'condition' => 'canCreate'
        ],
        [
            'option' => 'Update an active fast',
            'command' => UpdateCommand::class,
            'condition' => 'activeFasts',

        ],
        [
            'option' => 'End an active fast',
            'command' => EndCommand::class,
            'condition' => 'activeFasts',

        ],
        [
            'option' => 'List all fasts',
            'command' => ListCommand::class,
            'condition' => 'noCondition'
        ],
        [
            'option' => 'Exit',
            'command' => ExitCommand::class,
            'condition' => 'noCondition'
        ],

    ];

    public function __construct(
        protected InputConsole         $input,
        protected OutputConsole        $output,
        protected FileManagerInterface $store,
        protected InputValidator       $validator,
        protected Fast                 $newFast,
    )
    {
    }


    public function run()
    {
        while ($this->appRunning) {
            $this->updateActiveFastParameter();
            $this->updateCanCreateParameter();
            $this->adjustMenuAndPrint();
            $input = $this->input->getInput();
            if (key_exists($input, $this->menu)) {
                /**
                 * @var $command BaseCommandInterface
                 */
                $command = new $this->availableCommands[$input](
                    $this->input,
                    $this->output,
                    $this->store,
                    $this->validator,
                    $this->newFast,
                );
                $command->run();
            } else {
                $this->output->writeYellow('Please select a specific command.');
            }
        }
    }

    public function adjustMenuAndPrint()
    {
        $counter = 0;
        foreach ($this->menu as $key => $bundle) {
            ++$counter;
            $condition = $bundle['condition'];
            if ($this->{$condition}) {
                $this->output->write("[" . $counter . "] " . $bundle['option']);
                $this->availableCommands[$counter] = $bundle['command'];
            } else {
                $counter--;
            }
        }
    }

    /**
     * @throws \Exception
     */
    private function updateActiveFastParameter()
    {
        if ($this->store->hasActiveFasts()) {
            $this->activeFasts = true;
            return;
        }
        $this->activeFasts = false;
    }

    /**
     * @throws \Exception
     */
    private function updateCanCreateParameter()
    {
        if (!$this->store->hasActiveFasts()) {
            $this->canCreate = true;
            return;
        }
        $this->canCreate = false;
    }
}