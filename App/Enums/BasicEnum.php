<?php

namespace App\Enums;

use ReflectionClass;
use ReflectionException;

abstract class BasicEnum
{
    private static array|null $constCacheArray = NULL;

    /**
     * @return array
     * @throws ReflectionException
     */
    private static function getConstants(): array
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
     * @return bool|int|string
     * @throws ReflectionException
     */
    public static function fromValue(mixed $value): bool|int|string
    {
        $constants = self::getConstants();

        return array_search($value, $constants);
    }

    /**
     * Checks if the passed value exist as a constant in the called enum class.
     * @param string $value
     * @return bool
     * @throws ReflectionException
     */
    public static function isValid(string $value): bool
    {
        $constants = self::getConstants();
        return array_key_exists($value, $constants);
    }

    /**
     * Return all constants of the called enum class
     * @return array
     * @throws ReflectionException
     */
    public static function getAll(): array
    {
        return self::getConstants();
    }
}