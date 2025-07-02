<?php

namespace core\controllers;

use app\controllers\SiteController;
use core\exceptions\NotFoundException;


class AppController
{

    private static ?object $_self = null;
    private ?string $controller = null;
    private string $defController = "site";
    private ?string $action = null;
    private string $defAction = "index";
    private string $namespaceController = "app\\controllers\\";


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
            $self->route();
            if (!class_exists($self->controller)) {
                throw new NotFoundException("$self->controller not found!");
            }

            $controller = new $self->controller();

            // echo $controller->actionIndex();
            // echo (new SiteController)->actionIndex();
        } catch (\Exception $e) {
            $error  = new ErrorController($e->getMessage());
            echo $error->render();
        }
    }


    private function route(): void
    {
        $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $url = trim($url, "/");

        $urlParts = array_filter(explode("/", $url));

        $this->controller = !empty($urlParts[0])
            ? $this->getControllerName($urlParts[0])
            : $this->getControllerName($this->defController);

        $this->action = !empty($urlParts[1])
            ? $this->getActionName($urlParts[1])
            : $this->getActionName($this->defAction);
    }

    private function getControllerName($controller)
    {
        return
            $this->namespaceController
            . ucfirst($controller)
            . "Controller";
    }

    private function getActionName($action)
    {
        return
            "action"
            . ucfirst($action);
    }
}
