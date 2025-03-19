<?php

session_start();

if (empty($_SESSION["logged_in"])) {
    header("location: logowanie.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['wyczyść'])) {
    unset($_SESSION["koszyk"]);
    header("location: koszyk.php");
    exit();
}

$page_css = "koszyk.css";
include 'layout/header.php';
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
    <link rel="stylesheet" href="css/koszyk.css">
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
    <div class="koszyk">
        <ul>
            <?php
            if (!empty($_SESSION['koszyk'])) {
                foreach ($_SESSION['koszyk'] as $produkt) {
                    echo "<li>" . htmlspecialchars($produkt) . "</li>";
                }
            } else {
                echo "<p>Koszyk jest pusty</p>";
            }
            ?>
        </ul>

        <form method="POST">
            <button name="wyczyść" type="submit">Wyczyść koszyk</button>
        </form>

    </div>
</main>

<?php include_once 'layout/footer.php'; ?>