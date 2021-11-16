<?php

namespace App\Enums;

use ReflectionClass;

abstract class BasicEnum
{
    private static array|null $constCacheArray = NULL;

    private static function getConstants()
    {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    /**
     * @param mixed $value
     * @return false|int|string
     */
    public static function fromValue(mixed $value): bool|int|string
    {
        $constants = self::getConstants();

        return array_search($value, $constants);
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValidType(string $value): bool
    {
        $constants = self::getConstants();
        return array_key_exists($value, $constants);
    }

    public static function getAll()
    {
        return self::getConstants();
    }
}