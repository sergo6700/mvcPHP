<?php
session_start();

    require '../system/libs/functions.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    use system\core\Router;

    $query = rtrim($_SERVER['QUERY_STRING'], '/');
    define('WWW', __DIR__);#ayn papken vortex hima
    define('CORE', dirname(__DIR__) . '/system/core'); #cuyc kta system@
    define('ROOT',dirname(__DIR__));
    define('APP',dirname(__DIR__) . '/app');
    define('LAYOUT', 'default');
    spl_autoload_register(function ($class){
        $file = ROOT . "/" . str_replace('\\', '/', $class) . '.php';
        if (is_file($file)){
            require_once $file;
        }
    });
    include '../config/Routes.php';




Router::dispatch($query);