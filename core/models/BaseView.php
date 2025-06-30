<?php

namespace core\models;

class BaseView
{
    public string $layout = "";
    public $controller = "";
    private $cssFiles = [];
    private $pathCss = WEB_PATH . "css/";
    private $mainCss = "main.css";


    public function __construct()
    {
        $this->layout = LAYOUT_FILE;
        $this->cssFiles[] = $this->pathCss . $this->mainCss;
        // var_dump($this->cssFiles);
        // die;
    }

    public function render(string $fileHtml = "", array $data = []): string
    {
        $content = <<<HTML
            <div>index page</div>
        HTML;
        if (!empty($fileHtml)) {
            $content = $this->renderFile(VIEW_PATH
                . $this->controller . "/"
                . "$fileHtml.php", $data);
        }

        $data = ["content" => $content];

        return $this->renderFile($this->layout, $data);
    }

    public function renderFile(string $fileHtml, array $data = [])
    {
        extract($data);
        ob_start();
        include $fileHtml;
        $buffer = ob_get_contents();
        ob_end_clean();

        return $buffer;
    }

    public function setCssFile($fileCss)
    {
        $this->cssFiles[] = $fileCss;
    }

    public function getCssFiles()
    {
        return implode("\n", array_map(function($val) {           
            if (file_exists(APP_PATH . $val)) {
                return "<link rel=\"stylesheet\" href=\"$val\">";
            }
            return "";
        } , $this->cssFiles));
    }
}
