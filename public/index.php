<?php

session_start();

require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/controllers/UserController.php';

$db = Database::getInstance();
$controller = new UserController($db->getConnection());

if ($controller->logged_in()) {
    header('Location: ../app/views/panel.php');
} else {
    header('Location: ../app/views/logowanie.php');
}
exit();

