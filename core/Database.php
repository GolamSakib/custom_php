<?php
namespace Core;

class Database
{
    private $connection;
    private static $instance = null;

    private function __construct()
    {
        $config = require_once '../config/database.php';
        try {
            $this->connection = new \PDO(
                "mysql:host={$config['host']};dbname={$config['database']}",
                $config['username'],
                $config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
