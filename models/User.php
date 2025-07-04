<?php

namespace app\models;

use core\models\BaseDbModel;

class User extends BaseDbModel
{
    protected ?int $id = null;
    public string $name = "";
    public string $login = "";
    public string $password = "";
    public string $auth_key = "";

    public static function getTableName()
    {
        return "user";
    }

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT); // Хешируем пароль
        $this->auth_key = bin2hex(random_bytes(32)); // Генерируем ключ
        return $this->save();
    }
}
