<?php

require_once('../core/Model.php');

class UserModel extends Model
{
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
        $query = "SELECT password 
                  FROM users
                  WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        if ($hashed_password && password_verify($password, $hashed_password)) {
            return true;
        }
        return false;
    }

    public function insertUser(string $username, string $password): void
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $stmt->close();
    }
}