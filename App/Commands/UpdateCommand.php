<?php

namespace App\Commands;

use App\Interface\BaseCommandInterface;

class UpdateCommand extends BaseCommandController implements BaseCommandInterface
{

    public function run()
    {
        if ($activeFast = $this->store->getActiveFast()) {
            $userInput = $this->askForConfirmation("Are you sure you want to update your current active fast?");
            if (!$this->confirmationOptions[$userInput]) return;
            $this->output->write("This is your active fast {$activeFast->print()} Please reset start date and fast type:");
            $this->getStartDate();
            $this->getFastType();
            $this->setFastEndDate();
            $this->store->deleteActiveFast();
            $this->saveFast();
        }
    }
}