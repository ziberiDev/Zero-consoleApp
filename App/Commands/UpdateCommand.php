<?php

namespace App\Commands;

use App\Console\InputConsole;
use App\Console\OutputConsole;
use App\Interface\BaseCommandInterface;
use App\Model\FastEditor;
use App\Store\StoreManager;

class UpdateCommand extends FastEditor implements BaseCommandInterface
{

    public function run()
    {
        if ($activeFast = $this->store->getActiveFast()) {
            $this->output->write("This is your active fast {$activeFast->print()} Please reset start date and fast type:");
            $this->getStartDate();
            $this->getFastType();
            $this->setFastEndDate();
            $this->store->deleteActiveFast();
            $this->saveFast();
        }
    }
}