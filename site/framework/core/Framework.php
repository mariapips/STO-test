<?php


namespace framework\core;

class Framework
{
    public static function run()
    {
        self::autoload();
        self::dispatch();
    }

    private static function autoload()
    {
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    private static function load($classname)
    {
        $classname = '../' . str_replace('\\', '/', $classname) . '.php';
        if (file_exists($classname)) {
            require_once $classname;
        }
    }

    private static function dispatch()
    {
        $router = new Router();
        $router->passRequestToController();
    }
}