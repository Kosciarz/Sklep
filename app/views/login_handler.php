<?php

session_start();

if (!empty($_SESSION['logged_in'])) {
    header('Location: panel.php');
    exit();
}

if (!empty($_POST['create'])) {
    header('Location: register_handler.php');
    exit();
}

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../controllers/UserController.php';

$model = new User(DataBase::getInstance()->getConnection());
$controller = new UserController($model);
$view = new View($model);

$controller->login();

$view->render('logowanie');