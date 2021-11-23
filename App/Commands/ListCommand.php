<?php

namespace App\Commands;

use App\Console\{InputConsole, InputValidator, OutputConsole};
use App\Enums\Status;
use App\Interface\BaseCommandInterface;
use App\Model\{Collection, Fast};
use App\Store\StoreManager;

class ListCommand implements BaseCommandInterface
{

    public function __construct(
        protected InputConsole   $input,
        protected OutputConsole  $output,
        protected StoreManager   $store,
        protected InputValidator $validator,
        protected Fast           $newFast
    ){}

    public function run()
    {
        $fasts = $this->store->getAll();
        $this->listFasts($fasts);
    }

    /**
     * Accepts a collection and prints out in console.
     * @param Collection $fasts
     */
    private function listFasts(Collection $fasts)
    {
        $fasts->each(function ($key, $fast) {
            if ($fast->status !== Status::ACTIVE) {
                $this->output->write("Fast number:$key {$fast->print()}", 'red');

            }else{
                $this->output->write("Fast number:$key {$fast->print()}", 'green');
            }
        });
    }
}