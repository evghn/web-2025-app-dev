<?php
namespace core\controllers;

class IndexController extends WebController
{
    public function actionIndex()
    {
        return $this->render();
    }
}