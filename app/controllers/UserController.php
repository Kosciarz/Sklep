<?php

require_once('../core/Controller.php');

session_start();

class UserController extends Controller
{
    public function logged_in(): void
    {
        if (!empty($_SESSION['logged_in'])) {
            header('Location: ../views/panel.php');
            exit();
        }
    }

    public function create(): void
    {
        header('Location: rejestracja.php');
        exit();
        }

    public function log_in(): void
    {
        $error = "";

        if (isset($_POST["login"]) && isset($_POST["username"]) && isset($_POST["password"])) {
            $userModel = $this->model('UserModel');

            if (!$userModel->userExists($_POST['username'])) {
                $error = "UserModel not found!";
            } else {
                if ($userModel->checkPassword($_POST['username'], $_POST['password'])) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['name'] = $_POST['username'];
                    header('Location: panel.php');
                    exit();
                } else {
                    $error = "Invalid password!";
                }
            }
        }

        $this->view('logowanie', ['error' => $error]);
    }

    public function register(): void
    {
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST["create"])
            && isset($_POST["username"])
            && isset($_POST["password"])
            && isset($_POST["password-repeat"])) {

            if ($_POST["password"] !== $_POST["password-repeat"]) {
                $error = "Passwords did not match!";
            } else {
                $userModel = $this->model('UserModel');

                if ($userModel->userExists($_POST["username"])) {
                    $error = "Username already taken";
                } else {
                    $userModel->insertUser($_POST["username"], $_POST["password"]);
                    header('Location: ../views/logowanie.php');
                    exit();
                }
            }
        }

        $this->view('rejestracja', ['error' => $error]);
    }
}