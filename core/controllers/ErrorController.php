<?php
namespace core\controllers;

class ErrorController extends WebController
{    

    public function __construct()
    {
        $this->view->layout = LAYOUT_PATH . "error.php";
    }
    
    public function render(string $fileHtml = "", array $data = [])
    {
        
        return $this->view->render($fileHtml, $data);        
    }
    
}
