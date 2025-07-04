<?php

namespace app\controllers;

use app\models\User;
use core\controllers\WebController;

class UserController extends WebController
{
    public function actionRegister()
    {
        $user = new User;
        if ($this->isPost()) {
            $user->load($this->post());
            $user->register();
            $this->redirect("/");
        }

        return $this->render("register", ['model' => $user]);
    }
}
