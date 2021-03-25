<?php

class Database {
    private $host = 'localhost';
    private $name = 'zadanie3';
    private $username = 'root';
    private $password = '';

    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->name, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch( PDOException $exception ) {
            echo "Database could not be connected: " . $exception->getMessage();
        }

        return $this->connection;
    }

}