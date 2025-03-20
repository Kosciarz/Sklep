<?php

session_start();

if (empty($_SESSION["logged_in"])) {
    header("location: login_handler.php");
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