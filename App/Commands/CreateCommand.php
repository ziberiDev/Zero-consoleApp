<?php

namespace App\Commands;

use App\Interface\BaseCommandInterface;


class CreateCommand extends BaseCommandController implements BaseCommandInterface
{
    public function run()
    {
        $this->getStartDate();
        $this->getFastType();
        $this->setFastEndDate();
        $this->saveFast();
    }
}