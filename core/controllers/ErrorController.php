<?php

namespace core\controllers;

class ErrorController extends WebController
{

    public function __construct()
    {
        parent::__construct();
        $this->view->layout = "error";
        $this->view->setCssFile(ASSETS_CSS_PATH . "error.css");
    }

    public function render(string $text, array $data = []): string
    {
        return $this->view->renderLayout($text);
    }

    public function error(string $text)
    {
        echo $this->render($text);
    }
}
