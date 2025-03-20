<?php

session_start();

if (empty($_SESSION["logged_in"])) {
    header("location: login_handler.php");
    exit();
}

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/View.php';
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../controllers/BookController.php';

$model = new Book(Database::getInstance()->getConnection());
$controller = new BookController($model);
$view = new View($model);

if (!empty($_POST['add'])) {
    $controller->add();
} elseif (!empty($_POST['search'])) {
    $controller->search();
} elseif (!empty($_POST['delete'])) {
    $controller->delete();
} else {
    $controller->index();
}

$view->render('biblioteka');