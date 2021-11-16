<?php

namespace App\Store;

use App\Enums\Status;
use App\Interface\FileManagerInterface;
use App\Model\Collection;
use App\Model\Fast;
use DateTime;


class StoreManager implements FileManagerInterface
{

    protected string $file = "./store.json";


    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        $today = new DateTime('NOW');
        $fastArray = [];
        $storeFasts = json_decode(
            file_get_contents($this->file)
            , false);

        foreach ($storeFasts as $fast) {

            $newFast = new Fast(
                start: $fast->start,
                status: $fast->status,
                end: $fast->end,
                type: $fast->type
            );
            if ($fast->status !== Status::ACTIVE) {
                $newFast->setElapsedTime($today
                    ->diff($newFast->start)
                    ->format('%Y years %m months %d days %H h %i min %s sec'));

            } else {
                $newFast->setElapsedTime($fast->elapsed_time);
            }
            $fastArray[] = $newFast;

//            $fastArray[] = new Fast(
//                start: $fast->start,
//                status: $fast->status,
//                end: $fast->end,
//                type: $fast->type,
//                elapsedTime: $fast->elapsed_time);
        }
        return new Collection($fastArray);
    }

    public function select($key)
    {
        // TODO: Implement select() method.
    }

    public function write(object $fast)
    {
        // TODO: Implement write() method.
    }
}