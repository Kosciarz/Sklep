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

$page_css = "panel.css";
include 'layout/header.php';
?>

    <main>
        <h1>Odwiedziłeś naszą stronę <?= $_SESSION['counter'] ?> razy</h1>
    </main>

<?php include 'layout/footer.php'; ?>