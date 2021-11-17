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
     * @return void
     */
    public function getAll(): Collection
    {
        $today = new DateTime('NOW');
        $fastArray = [];
        $storeFasts = json_decode(
            file_get_contents($this->file)
            , false);
        if (!$storeFasts) {
            return new Collection([]);
        }
        foreach ($storeFasts as $fast) {
            $newFast = new Fast(
                start: $fast->start,
                status: $fast->status,
                end: $fast->end,
                type: $fast->type
            );
            if ($fast->status === Status::ACTIVE && $newFast->start < $today) {
                $newFast->setElapsedTime($today
                    ->diff($newFast->start)
                    ->format('%Y years %m months %d days %H h %i min %s sec'));

            } else {
                $newFast->setElapsedTime($fast->elapsed_time);
            }
            $fastArray[] = $newFast;
        }
        return new Collection($fastArray);
    }

    public function hasActiveFasts(): bool
    {
        $hasActive = false;
        $fasts = $this->getAll();

        if (!$fasts->toArray()) {
            $hasActive = false;
        }

        $fasts->each(function ($key, $fast) use (&$hasActive) {
            if ($fast->status == Status::ACTIVE) {
                $hasActive = true;
            }
        });

        return $hasActive;
    }

    public function select($key)
    {
        // TODO: Implement select() method.
    }

    public function write($fasts)
    {
        file_put_contents($this->file, json_encode($fasts));
    }
}