<?php

namespace core\controllers;

use core\models\BaseView;

class WebController extends BaseController
{
    public object $view;

    public function __construct()
    {
        $this->view = new BaseView();
        // var_dump(pathinfo($this::class));
        // die;
        $this->view->controller = $this->getId();
        // var_dump($this->view->controller);
    }

    public function render(string $fileHtml = "", array $data = [])
    {
        return $this->view->render($fileHtml, $data);
        
    }

    
}