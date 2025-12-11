<?php

namespace App\Service;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct(string $dsn, string $user, string $pass, array $options = [])
    {
        $this->pdo = new PDO($dsn, $user, $pass, $options + [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}