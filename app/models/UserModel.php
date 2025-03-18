<?php

require_once('../core/Model.php');

class UserModel extends Model
{
    private $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function userExists(string $username): bool
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    public function checkPassword(string $username, string $password): bool
    {
        $query = "SELECT id, username, password 
                  FROM users
                  WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        if ($result['password'] == $password) {
            return true;
        }
        return false;
    }

    public function insertUser(string $username, string $password): void
    {
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->close();
    }

}