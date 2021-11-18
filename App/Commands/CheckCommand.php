<?php

namespace App\Commands;

use App\Interface\BaseCommandInterface;
use App\Model\FastEditor;

class CheckCommand extends FastEditor implements BaseCommandInterface
{

    public function run()
    {
        if (!$activeFast = $this->store->getActiveFast()) {
            $this->output->write('You have no active fast please create one.');
            return;
        }
        $this->output->write($activeFast->print());
    }
}