<?php

session_start();

require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/View.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

$model = new User(Database::getInstance()->getConnection());
$controller = new UserController($model);
$view = new View($model);

if (!empty($_SESSION['logged_in'])) {
    header('Location: ../app/views/panel.php');
} else {
    header('Location: ../app/views/login_handler.php');
}
exit();

