<?php

class SQLiteDbManager
{
    private function createDB()
    {
        $file = fopen('app/db/db.sqlite', 'w');
        fclose($file);

        $pdo = new PDO('sqlite:app/db/db.sqlite');
        return $pdo;
    }

    private function createUserTable($pdo)
    {
        $query = "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            login VARCHAR(255),
            password VARCHAR(255),
            role INTEGER DEFAULT 1,
            hash VARCHAR(255),
            vk_user_id VARCHAR(255),
            vk_user_id_token VARCHAR(255),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($query);
    }

    private function createRoleTable($pdo)
    {
        $query = "CREATE TABLE IF NOT EXISTS roles (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(255) NOT NULL
        )";
        $pdo->exec($query);
    }

    private function insertRole($pdo, $role)
    {
        $query = "INSERT INTO roles (name) VALUES (:role)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

    public function initDB()
    {
        if (!file_exists('app/db/db.sqlite')) {
            $pdo = $this->createDB();
            $this->createUserTable($pdo);
            $this->createRoleTable($pdo);
            $this->insertRole($pdo, 'user');
            $this->insertRole($pdo, 'VKuser');
        }
    }
}
