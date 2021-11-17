<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Interface\BaseCommandInterface;
use App\Model\Collection;
use App\Store\StoreManager;

class ListCommand implements BaseCommandInterface
{

    public function __construct(
        protected InputConsole  $input,
        protected OutputConsole $output,
        protected StoreManager  $store
    )
    {
    }

    public function run()
    {
        $fasts = $this->store->getAll();

        $this->listFasts($fasts);
    }

    private function listFasts(Collection $fasts)
    {
        foreach ($fasts as $key => $fast) {
            $this->output->write("fast number:$key {$fast->print()}");
        }
    }


}