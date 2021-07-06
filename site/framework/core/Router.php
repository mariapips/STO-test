<?php

    namespace framework\core;
class Router
{
    /**
     * Парсер запроса
     *
     * @return array $routes
     */
    public function parse_request()
    {   $route[] = self::parse_json();
        for ($i = 0; $i < count($route); $i++) {
            if (preg_match('/^' . $route[$i]['route'] . '$/', $_SERVER['REQUEST_URI'])){
                $controller = new Controller();
                $controller->callController($route[$i]['controller']);

            }
        }
    }

        /**
         * Парсер json с правилами роутинга.
         *
         * @return array $routes
         */
    public static function parse_json()
    {
        $file = '../config/routes.json';
        $json = file_get_contents($file);
        $obj = json_decode($json, true);
        var_dump($obj);
        $index = count(array_keys($obj['routes']));
        $routes = array();
        for ($i = 0; $i < $index; $i++) {
             $routes[$i] = $obj['routes'][$i];
        }
        return $routes;
    }
}