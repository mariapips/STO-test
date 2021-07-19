<?php

namespace framework\core;
use app\controllers\StaticController;

class Controller
{

    public function callController($name, $action)
    {
        //TODO: call $name_controller.php
        $staticController = new StaticController();
        $page = $staticController->returnStaticPage($name);
        //echo $name . '' . $action;
        return $page;
    }
}