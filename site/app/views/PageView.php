<?php


namespace app\views;


class PageView
{
    private $title;
    private $page_name;

    public function __construct($title,$page_name){
        $this->title=$title;
        $this->page_name=$page_name;
    }

    public function render(){
        $title=$this->title;
        $page_name=$this->page_name;
        require 'templates/layout/main.php';
    }


}