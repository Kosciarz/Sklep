<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/UserController.php';

$db = Database::getInstance();
$controller = new UserController($db->getConnection());

if (isset($_POST['login'])) {
    $controller->log_in();
} elseif (isset($_POST['create'])) {
    $controller->create();
} else {
    $controller->logged_in();
}

?>


<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/logowanie.css">
</head>
<body>

<main>

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

        <div class="">
            <label for="name">Podaj imię:</label>
            <input type="text" name="username" id="name">
        </div>

        <div class="">
            <label for="password">Podaj hasło:</label>
            <input type="password" name="password" id="password">
        </div>

        <input type="submit" name="login" value="Zaloguj">

        <input type="submit" name="create" value="Utwórz konto">
    </form>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error ?></p>
    <?php endif; ?>

</main>

</body>
</html>