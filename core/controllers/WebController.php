<?php

namespace core\controllers;

use core\models\BaseView;
use core\models\User;


class WebController
{
    public ?object $view = null;
    public ?object $user = null;


    public function __construct()
    {
        session_start();
        $this->view = new BaseView();
        $this->user = new User();
    }

    public function render(string $fileHtml, array $data = []): string
    {
        return $this->view->renderLayout(
            $this->view->render($this->getId() . "/" . $fileHtml, $data)
        );
    }

    public function getId()
    {
        return strtolower(
            explode(
                "Controller",
                pathinfo(get_class($this))["filename"]
            )[0]
        );
    }


    public function isPost()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }

    public function redirect($url)
    {
        header("location: " . $url);
        exit;
    }

    public function post()
    {
        return $_POST;
    }
}
