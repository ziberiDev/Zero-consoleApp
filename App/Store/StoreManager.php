<?php

namespace App\Store;


use App\Interface\FileManagerInterface;

class StoreManager implements FileManagerInterface
{

    protected string $file = "./store.json";


    /**
     * @return false|string
     */
    public function getAll()
    {
        return file_get_contents($this->file);
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