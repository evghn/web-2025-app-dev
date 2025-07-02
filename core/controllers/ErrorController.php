<?php

namespace core\controllers;

class ErrorController extends WebController
{
    private string $error = '';

    public function __construct($error)
    {
        parent::__construct();
        $this->view->layout = LAYOUT_PATH . "error.php";
        $this->error = $error;
    }

    public function render(string $fileHtml = "", array $data = [])
    {

        return $this->view->render($fileHtml, ["content" => $this->error]);
    }
}
