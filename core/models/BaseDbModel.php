<?php

namespace core\models;

use core\controllers\AppController;
use Exception;

class BaseDbModel extends BaseModel
{
    public object $db;

    public function __construct()
    {
        $this->db = (Db::getInstance(AppController::getConfig()["db"]))->conn;
    }


    public function save(): bool
    {
        $tableName = static::getTableName();
        $attributes = $this->getAttribute();
        // var_dump($tableName, $attributes);
        if ($this->isInsert()) {
            //INSERT
            unset($attributes["id"]);
            try {
                $this->db->insert($tableName, $attributes);
                $this->setId($this->db->lastInsertId());
            } catch (Exception $e) {
                var_dump($e->getMessage());
                die;
            }
        } else {
            //INSERT
            $this->db->update(
                $tableName,
                $attributes,
                ['id' => $this->getId()] // Условие для обновления
            );
        }

        return true;
    }

    protected function isInsert()
    {
        return empty($this->getId());
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
