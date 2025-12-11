<?php

namespace App\Service;

use App\Repository\UserRepository;
use App\Repository\PositionRepository;

class ActionInvoker
{

    private $controller;
    private $action;

    public function __construct(string $controller, string $action)
    {
        $this->controller = $controller;
        $this->action     = $action;
    }

    public function invoke() {
        $refClass = new \ReflectionClass("App\\Controller\\".$this->controller);
        $refMethod = $refClass->getMethod($this->action);

        $object = $refClass->newInstanceArgs([]);

        $methodArgs = [];
        foreach ($refMethod->getParameters() as $param) {
            $type = $param->getType();
            if ($type instanceof \ReflectionNamedType) {
                if ($type->getName() === \PDO::class) {
                    $config = parse_ini_file('../config.ini', true);
                    $dbConfig = $config['database'];
                    $db = new Database($dbConfig['dsn'],$dbConfig['user'], $dbConfig['pass']);
                    $methodArgs[] = $db->getConnection();
                } else if ($type->getName() === Request::class) {
                    $methodArgs[] = new Request();
                } else if ($type->getName() === UserRepository::class) {
                    $methodArgs[] = new UserRepository();
                } else if ($type->getName() === PositionRepository::class) {
                    $methodArgs[] = new PositionRepository();
                } else {
                    $methodArgs[] = null;
                }
            } elseif ($param->isDefaultValueAvailable()) {
                $methodArgs[] = $param->getDefaultValue();
            } else {
                $methodArgs[] = null;
            }
        }

        return $refMethod->invokeArgs($object, $methodArgs);
    }
}