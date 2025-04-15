<?php

session_start();

if (!empty($_SESSION['logged_in'])) {
    header('Location: panel.php');
    exit();
}

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../controllers/UserController.php';

$model = new User(DataBase::getInstance()->getConnection());
$controller = new UserController($model);
$view = new View($model);

$controller->register();

$view->render('rejestracja');