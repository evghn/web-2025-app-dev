<?php

namespace app\controllers;

use core\controllers\WebController;


class SiteController extends WebController
{
    public function actionIndex()
    {
        $data = [
            "name" => "user - name",
        ];
        return $this->render('index', $data);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
