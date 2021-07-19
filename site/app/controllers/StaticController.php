<?php

namespace app\controllers;
use app\views\PageView;

class StaticController
{
    /*private $name;
    function __construct($name) {
        $this->name;
   }*/
    public function returnStaticPage($name){
        $page = new PageView('home', $name);
        $page->render();
        return $page;
    }

}