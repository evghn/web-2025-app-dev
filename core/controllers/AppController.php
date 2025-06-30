<?php
namespace core\controllers;

use app\controllers\SiteController;

class AppController
{
    
    private static ?object $_self = null;
    private string $controller = "site";
    private string $action = "index";

    private function __construct()
    {
        $this->controller = "Index";
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
        try {
            $self = static::getInstance();
            // $self->route();

            // $controller = new IndexController();
            // echo $controller->actionIndex();
            echo (new SiteController)->actionIndex();
        } catch(\Exception $e) {
            var_dump($e->getMessage());

        }
    }


    private function route()
    {
        $data = explode("/", $_SERVER["REQUEST_URI"]);
        $controller = $data[1];
        if (empty($controller)) {

        }

        // die;
    }
}
