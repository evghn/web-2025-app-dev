<?php
namespace core\controllers;

class AppController
{
    
    private static ?object $_self = null;
    private string $controller = "site";
    private string $action = "index";

    private function __construct()
    {
        
    }

    private static function getInstance()
    {
        if (static::$_self === null) {
            static::$_self = new static();
        }

        return static::$_self;
    }

    public static function run()
    {
        $self = static::getInstance();
        // $self->route();
        


        $controller = new IndexController();
        echo $controller->actionIndex();
    }


    private function route()
    {
        $data = explode("/", $_SERVER["REQUEST_URI"]);
        $controller = $data[1];
        if (empty($controller)) {

        }

        die;
    }
}
