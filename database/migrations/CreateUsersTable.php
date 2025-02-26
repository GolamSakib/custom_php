<?php
namespace Database\Migrations;

use Core\Database;

class CreateUsersTable
{

    private $db;

    public function __construct()
    {
        // Instantiate the Database class
        $this->db = Database::getInstance();
    }
    public function up()
    {
        $sql = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            avatar VARCHAR(255) DEFAULT NULL,
            user_type VARCHAR(50) DEFAULT 'user'
        )";
        $this->execute($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE IF EXISTS users";
        $this->execute($sql);
    }

    private function execute($sql)
    {
        $this->db->query($sql);
    }
}
