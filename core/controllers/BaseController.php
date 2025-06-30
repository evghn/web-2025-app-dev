<?php
namespace core\controllers;

class BaseController
{
    public function getId()
    {
        $fileName = strtolower(pathinfo($this::class)["filename"]);

        if (($pos = strpos($fileName, "controller")) !== false) {
            return substr($fileName, 0, $pos);
        }
    }
}
