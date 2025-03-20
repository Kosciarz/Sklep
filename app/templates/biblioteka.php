<?php
$page_css = "biblioteka.css";
require_once __DIR__ . '/../views/layout/header.php';
?>

    <main>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="wyszukiwanie">
                <input type="text" name="tytul" placeholder="tytul">

                <input type="text" name="autor" placeholder="autor">

                <select name="kategoria" id="kategoria">
                    <option value="0">wybierz kategorie</option>
                    <option value="1">horror</option>
                    <option value="2">obyczajowe</option>
                    <option value="3">dla dzieci</option>
                    <option value="4">fantazy</option>
                </select>
            </div>

            <div class="guziki">
                <input type="submit" name="add" value="Dodaj">

                <input type="submit" name="search" value="Szukaj">
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