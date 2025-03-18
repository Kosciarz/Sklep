<?php

session_start();

if (empty($_SESSION["logged_in"])) {
    header("location: logowanie.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dodaj']) && isset($_POST['produkty'])) {
    if (!empty($_SESSION['koszyk'])) {
        $_SESSION['koszyk'] = array_unique(array_merge($_SESSION['koszyk'], $_POST['produkty']));
    } else {
        $_SESSION['koszyk'] = $_POST['produkty'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pokaz'])) {
    if (!empty($_POST['siatka'])) {
        header("location: koszyk.php");
        exit();
    } else {
        $error = "Proszę wybrać siatkę!";
    }
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
    <link rel="stylesheet" href="css/sklep.css">
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
    <div class="sklep">
        <form action="<?= $_SERVER['PHP_SELF'] ?> " method="POST">
            <div class="siatki">
                <label for="siatka1">Siatka1</label>
                <input type="radio" name="siatka[]" id="siatka1">

                <label for="siatka2">Siatka2</label>
                <input type="radio" name="siatka[]" id="siatka2">

                <label for="siatka3">Siatka3</label>
                <input type="radio" name="siatka[]" id="siatka3">

                <label for="siatka4">Siatka4</label>
                <input type="radio" name="siatka[]" id="siatka4">
            </div>

            <div class="produkty">
                <label>
                    <select name="produkty[]" multiple id="produkty-select">
                        <option value="Telefon">Telefon</option>
                        <option value="Komputer">Komputer</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Słuchawki">Słuchawki</option>
                        <option value="Myszka">Myszka</option>
                        <option value="Ładowarka">Ładowarka</option>
                    </select>
                </label>
            </div>

            <button type="submit" name="dodaj">Dodaj</button>

            <button type="submit" name="pokaz">Pokaż koszyk</button>
        </form>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
