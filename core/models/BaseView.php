<?php

namespace core\models;

use core\exceptions\NotFoundException;
use core\exceptions\NotFoundFileException;

class BaseView
{
    public string $layout = "";
    private string $layoutDefault = "main";
    public $controller = "";
    private $cssFiles = [];
    private string $pathCss = ASSETS_CSS_PATH;
    private string $mainCss = "main.css";
    private string $viewPath = VIEW_PATH;


    public function __construct()
    {
        $this->cssFiles[] = $this->pathCss . $this->mainCss;
        $this->layout = LAYOUT_PATH . $this->layoutDefault;
        // var_dump($this->cssFiles);
        // die;
    }


    public function renderLayout(string $html): string
    {
        $fileLayout = $this->layout . ".php";
        return $this->renderFile($fileLayout, ["content" => $html]);
    }

    public function render(string $fileHtml = "", array $data = []): string
    {
        return $this->renderFile(
            $this->viewPath . "$fileHtml.php",
            $data
        );
    }

    public function renderFile(string $fileHtml, array $data = [])
    {
        if (!file_exists($fileHtml)) {
            throw new NotFoundException("Файл представления $fileHtml не найден!");
        }
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

    public function getLinkCssFiles()
    {
        return implode("\n", array_map(function ($val) {
            if (file_exists(APP_PATH . $val)) {
                return "<link rel=\"stylesheet\" href=\"$val\">";
            }
            return "";
        }, $this->cssFiles));
    }
}
