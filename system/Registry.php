<?php

namespace Kev;

class Registry
{
    use TSingleton;

    protected static array $properties = [];


    public function getProperty($name)
    {
        return self::$properties[$name] ?? null;
    }

    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }
}