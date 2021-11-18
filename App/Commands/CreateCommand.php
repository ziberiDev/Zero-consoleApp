<?php

namespace App\Commands;

use App\Model\FastEditor;
use App\Interface\BaseCommandInterface;


class CreateCommand extends FastEditor implements BaseCommandInterface
{
    public function run()
    {
        $this->getStartDate();
        $this->getFastType();
        $this->setFastEndDate();
        $this->saveFast();
    }
}