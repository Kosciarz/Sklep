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

$page_css = "logowanie.css";
include 'layout/header_login.php';
?>

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
            <p style="color: red;"><?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?></p>
        <?php endif; ?>

    </main>

<?php include 'layout/footer.php'; ?>