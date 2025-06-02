<?php

class Database
{
        private PDO $pdo;

        public function __construct()
        {
                $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=todoApp;charset=utf8mb4';
                $username = 'root';
                $password = 'fo39ajf3';


                try {
                        $this->pdo = new PDO($dsn, $username, $password);
                } catch (PDOException $e) {
                        die('Connection failed: ' . $e->getMessage());
                }
        }

        public function getPdo(): PDO
        {
                return $this->pdo;
        }
}

$db = new Database();
$pdo = $db->getPdo();

session_start();
