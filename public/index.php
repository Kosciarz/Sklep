<?php

require_once('../config/database.php');
require_once('../app/core/Database.php');

require_once('../app/controllers/UserController.php');

$db = Database::getInstance();
$controller = new UserController($db->getConnection());

if ($controller->logged_in()) {
    header("Location: ../app/views/panel.php");
} else {
    header("Location: ../app/views/logowanie.php");
}
exit();

