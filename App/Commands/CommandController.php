<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Interface\BaseCommandInterface;
use App\Interface\FileManagerInterface;
use App\Store\StoreManager;

class CommandController implements BaseCommandInterface
{

    public bool $appRunning = true;

    /**
     * @var array|string[]|BaseCommandInterface[]d
     */
    private array $commands = [
        1 => CreateCommand::class,
        4 => '',
        5 => ListCommand::class
    ];

    private array $options = [
        "1" => "Create a fast",
        "2" => "Start a fast",
        "4" => "Exit",
        "5" => "List all fasts",

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
            foreach ($this->options as $key => $option) {
                $this->output->write("[" . $key . "] " . $option);
            }
            $input = $this->input->getInput();
            if (key_exists($input, $this->commands) and $input != "4") {
                $command = new $this->commands["$input"]($this->input, $this->output, $this->store);

                $command->run();
            } elseif ($input == "4") {
                $this->appRunning = false;
            }
            $this->run();
        }

    }

    public function exit()
    {
        $this->appRunning = false;
    }


}