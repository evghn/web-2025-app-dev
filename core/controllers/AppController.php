<?php

namespace core\controllers;

use app\controllers\UserController;
use Exception;

class AppController
{
    private static ?object $self = null;
    private ?string $controller = null;
    private string $defController = "site";
    private string $defAction = "index";
    private ?string $action = null;
    private array $params = [];
    private string $controllerNamespace = "app\\controllers\\";
    private array $config = [];


    private function __construct() {}

    private static function getInstance()
    {
        if (static::$self == null) {
            static::$self = new static();
        }

        return static::$self;
    }

    public static function run($config)
    {
        try {
            $self = static::getInstance();
            $self->config = $config;
            $self->route();

            $reflection = new \ReflectionClass($self->controller);
            $controller = $reflection->newInstance();

            // Проверяем существование метода
            if (!$reflection->hasMethod($self->action)) {
                http_response_code(404);
                throw new \Exception("Not found in controller {$self->controller}::{$self->action}");
            }

            // Получаем рефлексию метода
            $method = $reflection->getMethod($self->action);

            // Проверяем, что метод публичный
            if (!$method->isPublic()) {
                http_response_code(404);
                throw new \Exception("Action {$self->action} is not accessible");
            }

            if ($method->getNumberOfParameters() > 0) {
                // Вызываем метод с параметрами           
                if (empty($self->params)) {
                    http_response_code(400);
                    throw new Exception("Не переданы аргументы для метода {$self->controller}::{$self->action}");
                }
                echo $method->invokeArgs($controller, $self->params);
            } else {
                // Метод не требует аргументы
                echo $method->invoke($controller);
            }
        } catch (Exception $e) {
            // Обрабатываем ошибки
            (new ErrorController())->error($e->getMessage());
        }
    }

    private function route()
    {
        // https://blog-app/
        $url = parse_url($_SERVER["REQUEST_URI"]);
        $urlParts = isset($url["path"])
            ? trim($url["path"], '/')
            : "";
        $urlPartsArray = array_filter(explode("/", $urlParts));

        $self = static::getInstance();
        $self->setController($urlPartsArray);
        $self->setAction($urlPartsArray);
        if (!class_exists($self->controller)) {
            throw new Exception("Класс " . $self->controller . " не найден!");
        }

        // Параметры из пути (/key/value/key2/value2)
        $pathParams = array_slice($urlPartsArray, 2);
        $self->params = $self->parsePathParams($pathParams);

        // Добавляем query-параметры (?key=value)
        if (isset($url['query'])) {
            parse_str($url['query'], $queryParams);
            $self->params = array_merge($self->params, $queryParams);
        }
    }

    private function setController(array $urlParts)
    {
        $self = static::getInstance();
        $self->controller = $self->controllerNamespace;
        $self->controller .= !empty($urlParts[0])
            ? ucfirst($urlParts[0])
            : ucfirst($self->defController);
        $self->controller .= "Controller";
    }

    private function setAction(array $urlParts)
    {
        $self = static::getInstance();
        $self->action = "action";
        $self->action .= !empty($urlParts[1])
            ? ucfirst($urlParts[1])
            : $self->defAction;
    }

    public function parsePathParams(array $params): array
    {
        $result = [];
        for ($i = 0; $i < count($params); $i += 2) {
            $key = $params[$i];
            $value = $params[$i + 1] ?? null;
            if ($key !== null) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public static function getParams()
    {
        return static::$self->params;
    }

    public static function getConfig()
    {
        return static::$self->config;
    }
}
