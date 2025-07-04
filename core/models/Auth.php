<?php

namespace core\models;

class Auth
{
    public bool $isGuest = false;

    public function getIdentity() {}

    public static function login(string $login, string $password): bool
    {
        $model = new User();
        $user = $model->findByLogin($login);

        if (!$user || !$model->validatePassword($password)) {
            return false;
        }
        return true;
    }
}
