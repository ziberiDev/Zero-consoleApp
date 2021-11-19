<?php

namespace App\Commands;

use App\Enums\Status;
use App\Interface\BaseCommandInterface;
use DateTime;

class EndCommand extends BaseCommandController implements BaseCommandInterface
{


    public function run()
    {
        $today = new DateTime('NOW');
        if ($activeFast = $this->store->getActiveFast()) {
            $userInput = $this->askForConfirmation("Are you sure you want to end current active fast?");
            while (!key_exists($userInput, $this->confirmationOptions)) {
                $userInput = $this->input->getInput();
            }
            if (!$this->confirmationOptions[$userInput]) return;
            // Once we have confirmation delete the current active fast from file.
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
            //Save the updated fast into file.
            $this->save($activeFast);
        }
    }

}