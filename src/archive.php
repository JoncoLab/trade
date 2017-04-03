<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 23:01
 */
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: start.html");
    session_unset();
    session_destroy();
    exit();
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXChange - правила користування майданчиком</title>
    <link href="styles/common.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js"></script>
</head>
<body>
<header>
    //= modules/menu.html
    //= modules/logo.html
</header>
<main>
</main>
//= modules/footer.html
</body>
</html>
