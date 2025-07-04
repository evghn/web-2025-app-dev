<?php

namespace core\models;

use Doctrine\DBAL\DriverManager;
use Exception;

class Db
{
    public $conn;
    private static ?object $_self = null;

    private function __construct(array $config)
    {
        $this->conn = DriverManager::getConnection($config);
    }


    public static function getInstance(?array $config = null)
    {
        if (self::$_self === null) {
            self::$_self = new self($config);
        }

        return self::$_self;
    }


    public function queryAssociative(string $query, array $params = []): array
    {
        $conn = $this->conn;

        try {
            if (!empty($params)) {
                $stmt = $conn->prepare($query);
                foreach ($params as $key => $val) {
                    $stmt->bindValue($key, $val);
                }
                $conn = $stmt->executeQuery();
            } else {
                $conn = $conn->executeQuery($query);
            }

            return $conn->fetchAllAssociative();
        } catch (\Exception $e) {
            throw new Exception("Ошибка обращения к базе данных");
        }
    }
}
