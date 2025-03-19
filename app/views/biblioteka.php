<?php

session_start();

if (empty($_SESSION["logged_in"])) {
    header("location: logowanie.php");
    exit();
}

$page_css = "biblioteka.css";
include 'layout/header.php';
?>

<main>



</main>

<?php include_once 'layout/footer.php'; ?>