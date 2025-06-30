<?php

namespace app\controllers;

use core\controllers\WebController;


class SiteController extends WebController
{
    public function actionIndex()
    {
        $data = [
            "user" => "user - name",
        ];
        return $this->render('index', compact('data'));
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    
}
