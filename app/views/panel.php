<?php

session_start();

if (empty($_SESSION['logged_in'])) {
    header('Location: logowanie.php');
    exit();
}

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter'] += 1;
}

?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/panel.css">
</head>
<body>

<header>
    <nav>
        <a href="panel.php" class="nav-item">Panel</a>
        <a href="sklep.php" class="nav-item">Sklep</a>
        <a href="biblioteka.php" class="nav-item">Biblioteka</a>
        <a href="wyloguj.php" class="nav-item">Wyloguj</a>
    </nav>
</header>

<main>
    <h1>Odwiedziłeś naszą stronę <?= $_SESSION['counter'] ?> razy</h1>
</main>

</body>
</html>
