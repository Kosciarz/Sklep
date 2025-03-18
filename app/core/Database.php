<?php

require_once('../../config/database.php');

class Database
{
    private static ?Database $instance = null;
    private mysqli $conn;

    private function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
            die('Error: Could not connect to database.' . mysqli_connect_error());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }

    public function query($sql): bool|mysqli_result
    {
        return $this->conn->query($sql);
    }

    public function prepare($sql): bool|mysqli_stmt
    {
        return $this->conn->prepare($sql);
    }

    public function close(): void
    {
        $this->conn->close();
    }
}