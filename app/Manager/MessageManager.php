<?php


namespace App\Manager;

use http\Exception\RuntimeException;
use Illuminate\Support\Manager;
use Illuminate\Support\Str;

class MessageManager extends Manager
{
    public function getDefaultDriver()
    {
        throw new RuntimeException('Default channel not set');
    }

    public function driverExists(string $driver): bool
    {
        $method = 'create'.Str::studly($driver).'Driver';

        $customDrivers = array_keys($this->customCreators);

        return in_array($driver, $customDrivers, true) || method_exists($this, $method);
    }
}
