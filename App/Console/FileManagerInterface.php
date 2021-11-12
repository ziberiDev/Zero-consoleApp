<?php

namespace App\Interface;

interface FileManagerInterface
{
    public function getAll();

    public function select($key);

    public function write(object $fast);
}