<?php
$page_css = "logowanie.css";
require_once __DIR__ . '/../views/layout/header_login.php';
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

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error;
                unset($error); ?></p>
        <?php endif; ?>

    </main>

<?php include 'layout/footer.php'; ?>