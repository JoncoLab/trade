<?php
session_start();
if (isset($_SESSION["id"])) {
    require_once "scripts/php/user.php";
    $user = User::getUserById($_SESSION["id"]);
    $_SESSION["ver"] = $user->ver;
    $_SESSION["access"] = $user->access;
}
if ($_SESSION["id"] == 'ADMIN') {
    header('Location: admin/admin.php');
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXChange - правила користування майданчиком</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/rules.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js"></script>
</head>
<body>
<header>
    <?php
    include "assets/menu.php";
    include "assets/logo.html";
    ?>
</header>
<main>
    <div class="video">
        <h2>Реєстрація для участі в електронних торгів</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/jGST9GTUa68" frameborder="0" allowfullscreen></iframe>
    </div>
    <div class="video">
        <h2>Заповнення заявки для участі в електронних торгах</h2>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/VXAZGzKRuEY" frameborder="0" allowfullscreen></iframe>
    </div>
</main>
<?php
include "assets/footer.html"
?>
</body>
</html>