<?php

namespace App\Helpers;

abstract class Json
{
    /**
     * @param string $values
     * @param bool $associative
     * @param int $depth
     * @param int $flags
     * @return mixed
     */
    public static function decode(string $values, bool $associative = false, int $depth = 512, int $flags = 0): mixed
    {
        return json_decode($values, $associative, $depth, $flags);
    }

    /**
     * @param mixed $value
     * @param int $flags
     * @param int $depth
     * @return false|string
     */
    public static function encode(mixed $value, int $flags = 0, int $depth = 512): bool|string
    {
        return json_encode($value, $flags, $depth);
    }
}