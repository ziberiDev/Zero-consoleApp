<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Enums\Status;
use App\Interface\BaseCommandInterface;
use App\Interface\FileManagerInterface;
use App\Model\Collection;


class CommandController implements BaseCommandInterface
{

    public bool $appRunning = true;

    protected bool $activeFasts = false;

    protected bool $canCreate = false;

    protected bool $noCondition = true;

    /**
     * @var array|string[][]
     */


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
        protected FileManagerInterface $store
    )
    {
    }


    public function run()
    {
        while ($this->appRunning) {
            $this->updateActiveFast();
            $this->updateCanCreate();
            $this->printMenu();
            $input = $this->input->getInput();
            if (key_exists($input, $this->menu)) {
                $command = new $this->menu[$input]['command']($this->input, $this->output, $this->store);
                $command->run();
            }
        }
    }

    public function printMenu()
    {
        foreach ($this->menu as $key => $bundle) {
            $condition = $bundle['condition'];
            if ($this->{$condition}) {
                $this->output->write("[" . $key . "] " . $bundle['option']);
            }
        }
    }

    private function updateActiveFast()
    {
        if ($this->store->hasActiveFasts()) {
            $this->activeFasts = true;
            return;
        }
        $this->activeFasts = false;
    }

    private function updateCanCreate()
    {
        if (!$this->store->hasActiveFasts()) {
            $this->canCreate = true;
            return;
        }
        $this->canCreate = false;
    }


}