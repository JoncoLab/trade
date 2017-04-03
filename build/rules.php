<?php
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
    <script src="scripts/js/script.js"></script>
</head>
<body>
<header>
    <menu class="main-menu" xmlns="http://www.w3.org/1999/html">
        <img class="menu-icon" src="SVG/menu.svg">
        <span>Меню</span>
        <ul class="menu">
            <li><img class="ico" src="SVG/user-light.svg"><a href="cabinet-page.php">Мій кабінет</a></li>
            <li><img class="ico" src="SVG/office-light.svg"><a href="../about.php">Про компанію</a></li>
            <li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.php">Новини проекту</a></li>
            <li><img class="ico" src="SVG/book-light.svg"><a href="../rules.php">Правила та умови</a></li>
            <?php
            if ($_SESSION["ver"] === '1') {
                echo
                '<li><img class="ico" src="SVG/hammer2-light.svg"><a href="auction.php">Аукціон</a></li>' .
                '<li><img class="ico" src="SVG/doc-light.svg"><a href="application.php">Подати заявку на участь в торгах</a></li>' .
                '<li><img class="ico" src="SVG/archive-light.svg"><a href="archive.php">Архів заявок</a></li>';
            }
            ?>
            <li><img class="ico" src="SVG/exit-light.svg"><a href="../scripts/php/logout.php">Вихід</a></li>
        </ul>
    </menu>
    <div class="logo">
        <img src="images/logo.png" alt="Логотип">
        <h1>EXChange</h1>
    </div>
</header>
<main>
</main>
<footer>
    <a class="contacts footer-item" href="../about.php"> <span>Наші контактні дані:</span>
        <br> <img class="contacts-logo" src="SVG/address-book-light.svg"> </a>
    <!--<div class="feedback footer-item"> <span>Залиште свій відгук!</span>-->
        <!--<br> <img src="SVG/bubbles-light.svg" class="feedback-logo"> </div>-->
    <a class="developers footer-item" href="http://www.joncolab.pro"> <span>Site developed by:</span>
        <br> <img class="jonco-logo" src="images/logo-jonco.png"> </a>
    <script>
        $('.feedback').click(function () {
            $('.feedback-form').toggle(300);
            if ($('.feedback-form').css('display') === 'block') {
                $('.feedback-form').css('display', 'flex');
            }
        });
    </script>
</footer>
</body>
</html>