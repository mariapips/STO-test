<?php

namespace framework\core;

class Router
{

    public function passRequestToController()
    {
        $routes_json[] = self::getRoutesFromJson();
        $controller = new Controller();
        $request = $_SERVER['REQUEST_URI'];
        $url_request = explode("/", $request, 3);
        $url = $url_request[1];
        $action = $url_request[2];
        $routes_array = $this->allRoutes($routes_json);
        foreach ($routes_json[0] as $value) {
            if ($this->isMatch($value['route'], $url)) {
                $controller->callController($value['controller'], $this->methodType($value['actions'], $action));
                break;
            } elseif (in_array($url, $routes_array)) {
                continue;
            }
            elseif ($url == 'public'){
                if(file_exists($action)){
                    include (__DIR__.'/../..'.$request);
                    break;
                }
                else echo 'error!!!';
            }
            else {
                http_response_code(404);
                $controller->callController('error', 'show');
                break;
            }
        }
    }


    /**
     *
     * @return array $routes_json
     */
    public
    static function getRoutesFromJson(): array
    {
        $file = '../framework/config/routes.json';
        $json = file_get_contents($file);
        $routes_json = json_decode($json, true);

        return $routes_json['routes'];
    }

    /**
     *
     * @param string $route
     * @param string $url
     * @return bool
     */
    private function isMatch(string $route, string $url): bool
    {
        return preg_match('#^' . $route . '$#', $url) ? true : false;
    }

    /**
     *
     * @param array $routes_json
     * @return array $route_array
     */
    private function allRoutes(array $routes_json): array
    {
        $route_array = array();
        foreach ($routes_json[0] as $value) {
            $route_array[] = $value['route'];
        }
        return $route_array;
    }

    /**
     *
     * @param array $actions
     * @param $url
     * @return string $route_array
     */
    private function methodType(array $actions, $url): string
    {
        $action = '';
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $action = 'show';
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            foreach ($actions as $value) {
                if ($this->isMatch($value, $url)) {
                    $action = $value;
                    break;
                } elseif (in_array($url, $actions)) {
                    continue;
                } else {
                    $action = 'error';
                }
            }
        } else {
            $action = 'error';
        }
        return $action;
    }

}
