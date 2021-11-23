<?php

namespace App\Store;

use App\{Enums\Status, Helpers\Json, Interface\FileManagerInterface, Model\Collection, Model\Fast};
use DateTime;
use Exception;


class StoreManager implements FileManagerInterface
{

    protected string $file;

    public function __construct()
    {
        if (!file_exists($_ENV['APP_STORAGE'])) {
            try {
                fopen($_ENV['APP_STORAGE'], 'w');
            } catch (\Throwable $e) {

            }

        }
        $this->file = $_ENV['APP_STORAGE'];

    }

    /**
     * Fetches all fasts from store.json if any and returns a collection
     * @return Collection
     * @throws Exception
     */
    public function getAll(): Collection
    {
        $today = new DateTime('NOW');
        $fastArray = [];
        $storeFasts = Json::decode(
            file_get_contents("$this->file")
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
                $newFast->set(
                    [
                        'elapsedTime' => $today
                            ->diff($newFast->start)
                            ->format('%Y years %m months %d days %H h %i min %s sec')
                    ]
                );

            } else {
                $newFast->set([
                    'elapsedTime' => $fast->elapsed_time
                ]);
            }
            $fastArray[] = $newFast;
        }
        return new Collection($fastArray);
    }

    /**
     * Checks if there are any active fasts in file.
     * @return bool
     * @throws Exception
     */
    public function hasActiveFasts(): bool
    {
        $hasActive = false;
        $fasts = $this->getAll();

        if (!$fasts->toArray()) {
            return $hasActive;
        }
        $fasts->each(function ($key, $fast) use (&$hasActive) {
            if ($fast->status == Status::ACTIVE) {
                $hasActive = true;
            }
        });
        return $hasActive;
    }

    /**
     * @param $key
     */
    public function select($key)
    {
        // TODO: Implement select() method.
    }

    /**
     * @return bool|Fast
     * @throws Exception
     */
    public function getActiveFast(): bool|Fast
    {
        if (!$this->hasActiveFasts()) return false;

        $fasts = $this->getAll();
        $activeFast = false;

        $fasts->each(function ($key, $fast) use (&$activeFast) {
            if ($fast->status == Status::ACTIVE) {
                $activeFast = $fast;
            }
        });
        return $activeFast;
    }

    /**
     * Writes the past parameter into the store file.
     * @param  $fasts
     */
    public function write($fasts)
    {
        file_put_contents($this->file, Json::encode($fasts));
    }

    /**
     * Delete an Active fast from store file
     */
    public function deleteActiveFast()
    {
        $fasts = $this->getAll();
        $fastsWithoutActiveFasts = [];

        $fasts->each(function ($key, $fast) use (&$fastsWithoutActiveFasts) {
            if ($fast->status == Status::INACTIVE) {
                $fastsWithoutActiveFasts[] = $fast;
            }
        });

        $this->write($fastsWithoutActiveFasts);
    }
}