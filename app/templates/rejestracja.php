<?php
$page_css = "logowanie.css";
require_once __DIR__ . '/../views/layout/header_login.php';
?>

    <main>

        <h2>Utwórz konto</h2>

        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

            <div>
                <label for="name">Podaj imię:</label>
                <input type="text" name="username" id="name" value="<?= $_POST["username"] ?? "" ?>">
            </div>

            <div>
                <label for="password">Podaj hasło:</label>
                <input type="password" name="password" id="password">
            </div>

            <div>
                <label for="password-repeat">Powtórz hasło:</label>
                <input type="password" name="password-repeat" id="password-repeat">
            </div>

            <input type="submit" name="create" value="Utwórz">
        </form>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error ?></p>
        <?php endif; ?>

    </main>

<?php include 'layout/footer.php'; ?>