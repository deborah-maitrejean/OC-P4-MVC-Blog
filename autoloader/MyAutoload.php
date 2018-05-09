<?php

namespace Autoloader;

/**
 * Class MyAutoload
 * @package Autoloader
 */
class MyAutoload
{
    public static function start()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * @param $class
     */
    public static function autoload($class)
    {
        $path = str_replace('\\', '/', $class);
        require '../' . lcfirst($path) . '.php';
    }
}