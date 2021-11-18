<?php

namespace App\Commands;

use App\Enums\Status;
use App\Interface\BaseCommandInterface;
use App\Model\Fast;
use App\Model\FastEditor;
use DateTime;

class EndCommand extends FastEditor implements BaseCommandInterface
{
    protected array $menu = [
        "Y" => true,
        "N" => false
    ];

    public function run()
    {
        $today = new DateTime('NOW');
        if ($activeFast = $this->store->getActiveFast()) {
            $this->output->write('Are you sure tou want to end current active fast.');
            $this->printMenu();
            $userInput = strtoupper($this->input->getInput());
            while (!key_exists($userInput, $this->menu)) {
                $userInput = $this->input->getInput();
            }
            if (!$userInput) return;
            $this->store->deleteActiveFast();
            $activeFast->set([
                'status' => Status::INACTIVE,
            ]);
            if ($activeFast->start < $today) {
                $activeFast->set([
                    'elapsedTime' => $today->diff($activeFast->start)
                        ->format('%Y years %m months %d days %H h %i min %s sec')
                ]);
            }
            $this->save($activeFast);
        }
    }

    protected function printMenu()
    {
        foreach ($this->menu as $key => $value) {
            $this->output->write("[$key]");
        }
    }



}