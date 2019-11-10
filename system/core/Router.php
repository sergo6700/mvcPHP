<?php

namespace system\core;

class Router{

    protected static $routes = [];

    protected static  $route = [];

    public static function add($regexp, $route = []){

        self::$routes[$regexp] = $route;

    }

    public static function getRoutes(){
        return self::$routes;
    }
    public static function getRoute(){
        return self::$route;
    }

    public static function matchRoute($url){

        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#$pattern#i", $url, $matches)){
                foreach ($matches as $k => $v){
                    if (is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if (!isset($route['action'])){
                    $route['action'] = 'index';
                }

                $route['controller'] = upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    protected static function removeQuerystring($url){

        if ($url){
            $params = explode('&', $url, 2);
            if (!strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }
            else{
                return '';
            }
        }
        return $url;
    }

    public static function dispatch($url){
        $url = self::removeQuerystring($url);
        if (self::matchRoute($url)){
            $controller = '\app\controllers\\' . self::$route['controller'] . 'Controller';
            if (class_exists($controller)){
                $cObj = new $controller(self::$route);
                $action = lowerCamelCase(self::$route['action']) . 'Action';
                if (method_exists($cObj, $action)){
                    $cObj->$action();
                    $cObj->getView();
                }
                else{
                    echo "method $controller::$action not found";
                }
            }
            else{
                echo 'controller not found';
            }
        }
        else{
            http_response_code(404);
            include "404.html";
        }
    }
}