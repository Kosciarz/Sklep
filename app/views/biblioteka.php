<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../controllers/BookController.php';

if (empty($_SESSION["logged_in"])) {
    header("location: logowanie.php");
    exit();
}

$db = Database::getInstance();
$controller = new BookController($db->getConnection());

if (isset($_POST['dodaj'])) {
    $controller->add();
} elseif (isset($_POST['szukaj'])) {
    $controller->search();
} elseif (isset($_POST['usun'])) {
    $controller->delete();
} else {
    $controller->index();
}

$page_css = "biblioteka.css";
include 'layout/header.php';
?>

    <main>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="wyszukiwanie">
                <input type="text" name="tytul" placeholder="tytul">

                <input type="text" name="autor" placeholder="autor">

                <select name="kategoria" id="kategoria">
                    <option value="null">wybierz kategorie</option>
                    <option value="horror">horror</option>
                    <option value="obyczajowe">obyczajowe</option>
                    <option value="fantazy">fantazy</option>
                    <option value="dzieci">dla dzieci</option>
                </select>
            </div>

            <div class="guziki">
                <input type="submit" name="dodaj" value="Dodaj">

                <input type="submit" name="szukaj" value="Szukaj">
            </div>

            <div class="wyniki">
                <?php if (!empty($books)): ?>
                    <table>
                        <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Autor</th>
                            <th>Kategoria</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?= htmlspecialchars($book['tytul']) ?></td>
                                <td><?= htmlspecialchars($book['autor']) ?></td>
                                <td><?= htmlspecialchars($book['nazwa']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Brak wyników.</p>
                <?php endif; ?>
            </div>

        </form>

    </main>

<?php include_once 'layout/footer.php'; ?>