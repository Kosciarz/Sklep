<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../core/Controller.php';

class UserController extends Controller
{
    public function login(): void
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return;
        }

        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $error = "All fields are required";
            $this->model_->setData('error', $error);
            return;
        }

        if (!$this->model_->userExists($_POST['username'])) {
            $error = "User not found!";
            $this->model_->setData('error', $error);
            return;
        }

        if (!$this->model_->verifyPassword($_POST['username'], $_POST['password'])) {
            $error = "Invalid password!";
            $this->model_->setData('error', $error);
            return;
        }

        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $_POST['username'];

        header('Location: panel.php');
        exit();
    }

    public function register(): void
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            return;
        }

        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["password-repeat"])) {
            $error = "All fields are required";
            $this->model_->setData('error', $error);
            return;
        }

        if ($_POST["password"] != $_POST["password-repeat"]) {
            $error = "Passwords did not match";
            $this->model_->setData('error', $error);
            return;
        }

        if ($this->model_->userExists($_POST["username"])) {
            $error = "Username already taken";
            $this->model_->setData('error', $error);
            return;
        }

        $this->model_->insertUser($_POST["username"], $_POST["password"]);
        $_SESSION['logged_in'] = true;
        $_SESSION['name'] = $_POST['username'];
        header('Location: panel.php');
        exit();
    }
}