<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sklep</title>

    <link rel="stylesheet" href="/Sklep/app/views/css/global.css">
    <link rel="stylesheet" href="/Sklep/app/views/css/header.css">
    <link rel="stylesheet" href="/Sklep/app/views/css/navbar.css">
    <link rel="stylesheet" href="/Sklep/app/views/css/panel.css">

    <?php if (isset($page_css)): ?>
        <link rel="stylesheet" href="/Sklep/app/views/css/<?php echo $page_css; ?>">
    <?php endif; ?>
</head>
<body>

<header>
    <nav>
        <a href="/Sklep/app/views/panel.php" class="nav-item">Panel</a>
        <a href="/Sklep/app/views/sklep.php" class="nav-item">Sklep</a>
        <a href="/Sklep/app/views/biblioteka.php" class="nav-item">Biblioteka</a>
        <a href="/Sklep/app/views/wyloguj.php" class="nav-item">Wyloguj</a>
    </nav>
</header>