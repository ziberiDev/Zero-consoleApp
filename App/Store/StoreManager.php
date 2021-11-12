<?php

namespace App\Store;


use App\Interface\FileManagerInterface;
use App\Model\Collection;
use App\Model\Fast;


class StoreManager implements FileManagerInterface
{

    protected string $file = "./store.json";


    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        $fastArray = [];
        $storeFasts = json_decode(
            file_get_contents($this->file)
            , false);

        foreach ($storeFasts as $fast) {
            $fastArray[] = new Fast(
                $fast->status,
                $fast->start,
                $fast->end,
                $fast->elapsed_time,
                $fast->type
            );
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