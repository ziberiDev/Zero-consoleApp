<?php

namespace App\Interface;

use App\Model\Collection;
use App\Model\Fast;

interface FileManagerInterface
{
    public function getAll() :Collection;

    public function write(array $fasts);

    public function hasActiveFasts(): bool;

    public function getActiveFast(): bool|Fast;

    public function deleteActiveFast();
}