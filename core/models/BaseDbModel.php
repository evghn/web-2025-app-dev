<?php

namespace core\models;

class BaseDbModel extends BaseModel
{
    public object $db;

    public function __construct()
    {
        $this->db = Db::getInstance();
    }
}
