<?php

namespace App\Commands;

use App\Interface\BaseCommandInterface;

class CheckCommand extends BaseCommandController implements BaseCommandInterface
{

    public function run()
    {
        if (!$activeFast = $this->store->getActiveFast()) {
            $this->output->writeError('You have no active fast please create one.');
            return;
        }
        $this->output->writeGreen($activeFast->print());
    }
}