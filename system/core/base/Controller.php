<?php
namespace system\core\base;

class Controller {

    public $route = [];
    public $view;
    public $layout;
    public $data = [];
    public $info = [];
    public function __construct($route){

        $this->route = $route;
        $this->view = $route['action'];

    }

    public function getView(){
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->data, $this->info);
    }

    public function set($data, $info = null){

        $this->data = $data;

        if (!is_null($info)){
            $this->info = $info;
        }

    }
}