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


    private array $menu = [
        [
            'option' => 'Create Fast',
            'command' => CreateCommand::class,
            'condition' => 'canCreate'
        ],
        [
            'option' => 'Exit',
            'command' => "",
            'condition' => 'noCondition'
        ],
        [
            'option' => 'Update an active fast',
            'command' => UpdateCommand::class,
            'condition' => 'activeFasts',
            'operand' => '> 0'
        ],
        [
            'option' => 'List all fasts',
            'command' => ListCommand::class,
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

            $this->run();
        }

    }

    public function exit()
    {
        $this->appRunning = false;
    }

    public function printMenu()
    {
        $counter = 0;
        foreach ($this->menu as $key => $bundle) {

            $condition = $bundle['condition'];

            if ($this->{$condition}) {

                $this->output->write("[" . $key . "] " . $bundle['option']);


            }

        }
    }

    private function updateActiveFast()
    {
        /**
         * @var $fasts Collection
         */
        $fasts = $this->store->getAll();
        $fasts->each(callback: function ($key, $fast) {

            if ($fast->status == Status::ACTIVE) {

                $this->activeFasts = true;

            }
        });

    }

    private function updateCanCreate()
    {
        /**
         * @var $fasts Collection
         */
        $fasts = $this->store->getAll();
        $fasts->each(function ($key, $fast) {
            if ($fast->status == Status::ACTIVE) {

                $this->canCreate = false;
                return;
            }
            $this->canCreate = true;

        });
    }


}