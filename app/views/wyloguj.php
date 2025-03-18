<?php

session_start();

if (empty($_SESSION["logged_in"])) {
    header("location: logowanie.php");
    exit();
} else {
    session_unset();
}

session_destroy();

?>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: x-large;
        }



    </style>
</head>
<body>

    <main>
        <h1>Wylogowano!</h1>
    </main>

</body>
</html>
