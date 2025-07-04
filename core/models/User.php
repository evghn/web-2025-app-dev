<?php

namespace core\models;

use core\controllers\AppController;

class User extends BaseDbModel
{
    private $_user;


    public function __construct()
    {
        $this->_user = new (AppController::getConfig()["user"]["class"]);
    }


    public function login(string $login, string $password): bool
    {
        $user = $this->findByLogin($login);

        if (!$user || !$this->validatePassword($password)) {
            return false;
        }

        return true;
    }

    public function validatePassword(string $password): bool
    {
        return password_verify($password, $this->_user->password);
    }

    public function findByLogin(string $login): ?User
    {
        $result = Db::getInstance()->queryAssociative(
            "SELECT * "
                . "FROM " . $this->_user::getTableName()
                . "WHERE login = :login",
            ["login" => $login]
        );

        return $result ? $this->createFromArray($result) : null;
    }

    public function createFromArray(array $data): User
    {

        foreach ($data as $key => $value) {
            if (property_exists($this->_user, $key)) {
                $this->_user->$key = $value;
            }
        }
        return $this->_user;
    }
}
