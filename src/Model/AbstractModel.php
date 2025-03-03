<?php

declare(strict_types=1);

namespace App\Model;
use PDO;

class AbstractModel
{
    protected PDO $conn;
    public function __construct(array $db_config)
    {
        $dsn = "mysql:dbname={$db_config['database']};host={$db_config['host']}";
        $this->conn = new PDO(
            $dsn,
            $db_config['user'],
            $db_config['password']
        );
    }
}