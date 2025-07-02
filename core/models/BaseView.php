<?php

namespace core\models;

use core\exceptions\NotFoundException;
use core\exceptions\NotFoundFileException;

class BaseView
{
    public string $layout = "";
    private string $layoutDefault = "main.php";
    public $controller = "";
    private $cssFiles = [];
    private string $pathCss = WEB_PATH . "css/";
    private string $mainCss = "main.css";
    private string $viewPath = VIEW_PATH;


    public function __construct()
    {
        $this->cssFiles[] = $this->pathCss . $this->mainCss;
        $this->layout = LAYOUT_PATH . $this->layoutDefault;
        // var_dump($this->cssFiles);
        // die;
    }

    public function render(string $fileHtml = "", array $data = []): string
    {


        if (!empty($fileHtml)) {
            $content = $this->renderFile(
                $this->viewPath
                    . $this->controller . "/"
                    . "$fileHtml.php",
                $data
            );
        } else {
            if (empty($data)) {
                $content = "";
            } else {
                $content = $data["content"];
            }
        }

        $data = ["content" => $content];

        return $this->renderFile($this->layout, $data);
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

    public function getCssFiles()
    {
        return implode("\n", array_map(function ($val) {
            if (file_exists(APP_PATH . $val)) {
                return "<link rel=\"stylesheet\" href=\"$val\">";
            }
            return "";
        }, $this->cssFiles));
    }
}
