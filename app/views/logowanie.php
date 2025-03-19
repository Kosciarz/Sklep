<?php

session_start();

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/UserController.php';

$db = Database::getInstance();
$controller = new UserController($db->getConnection());

if ($controller->logged_in()) {
    header('Location: panel.php');
    exit();
}

if (isset($_POST['login'])) {
    $controller->log_in();
} elseif (isset($_POST['create'])) {
    header('Location: rejestracja.php');
    exit();
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

    <link rel="stylesheet" href="/Sklep/app/views/css/global.css">
    <link rel="stylesheet" href="/Sklep/app/views/css/logowanie.css">
</head>
<body>

<main>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <div>
            <label for="name">Podaj imię:</label>
            <input type="text" name="username" id="name">
        </div>

        <div>
            <label for="password">Podaj hasło:</label>
            <input type="password" name="password" id="password">
        </div>

        <input type="submit" name="login" value="Zaloguj">

        <input type="submit" name="create" value="Utwórz konto">
    </form>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

</main>

</body>
</html>