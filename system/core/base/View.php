<?php


namespace system\core\base;


class View{

    public $route = [];

    #this view
    public $view;

    #this shablon
    public $layout;

    public function __construct($route, $layout = '', $view = ''){
        $this->route = $route;
        if ($layout === false){
            $this->layout = false;
        }
        else{
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function render($data, $info = null){
        if (is_array($data)){
            extract($data);
        }
        if (!is_null($info) && is_array($info)){
            extract($info);
        }
        $file_view = APP . "/view/{$this->route['controller']}/{$this->view}.php";

        ob_start();

        if (is_file($file_view)){
            require $file_view;
        }
        else{
            echo 'not found this view';
        }

        $content = ob_get_clean();
        if (false !== $this->layout){
            $file_layout = APP . "/view/layouts/{$this->layout}.php";
            if (is_file($file_layout)){
                require $file_layout;
            }
            else{
                echo 'shablon not faund';
            }
        }

    }
}