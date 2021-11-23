<?php

namespace App\Commands;

use App\Interface\BaseCommandInterface;

class CheckCommand extends BaseCommandController implements BaseCommandInterface
{
    public function run()
    {
        if (!$activeFast = $this->store->getActiveFast()) {
            $this->output->write('You have no active fast please create one.', 'red');
            return;
        }
        $this->output->write($activeFast->print(), 'green');
    }
}