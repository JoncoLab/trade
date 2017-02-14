<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: start.html");
    session_unset();
    session_destroy();
    exit();
}
print $_SESSION["id"];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXChange - правила користування майданчиком</title>
    <link href="styles/common.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/script.js"></script>
</head>
<body>
<header>
    //= modules/logo.html
</header>
<main>
    //= modules/menu.html
</main>
//= modules/footer.html
</body>
</html>