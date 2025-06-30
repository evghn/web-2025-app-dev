<?php

namespace app\controllers;

use core\models\BaseView;

class SiteController
{
    public object $view;

    public function __construct()
    {
        $this->view = new BaseView();
        // var_dump(pathinfo($this::class));
        // die;
        $this->view->controller = $this->getId();
    }

    public function render(string $fileHtml, array $data = [])
    {
        echo $this->view->render($fileHtml, $data);
    }

    public function getId()
    {
        $fileName = strtolower(pathinfo($this::class)["filename"]);

        if (($pos = strpos($fileName, "controller")) !== false) {
            return substr($fileName, 0, $pos);
        }
    }
}
