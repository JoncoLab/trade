<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: start.html");
    session_unset();
    session_destroy();
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>EXChange - про компанію</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/about.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/script.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <img src="images/logo.png" alt="Логотип">
        <h1>EXChange</h1>
    </div>
</header>
<main>
    <menu class="main-menu"> <img class="menu-icon" src="SVG/menu.svg"> <span>Меню</span>
        <ul class="menu">
            <li><img class="ico" src="SVG/user-light.svg"><a href="cabinet-page.php">Мій кабінет</a></li>
            <li><img class="ico" src="SVG/hammer2-light.svg"><a href="auction.php">Аукціон</a></li>
            <li><img class="ico" src="SVG/office-light.svg"><a href="../about.php">Про компанію</a></li>
            <li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.php">Новини проекту</a></li>
            <li><img class="ico" src="SVG/book-light.svg"><a href="../rules.php">Правила та умови</a></li>
            <li><img class="ico" src="SVG/doc-light.svg"><a href="application.php">Подати заявку на участь в торгах</a></li>
            <li><img class="ico" src="SVG/archive-light.svg"><a href="archive.php">Архів заявок</a></li>
            <li><img class="ico" src="SVG/exit-light.svg"><a href="logout.php">Вихід</a></li>
        </ul>
        <script>
            $(document).ready(function () {
                $('.main-menu .menu-icon, .main-menu > span').hover(function () {
                    $('.main-menu .menu-icon').css('transform', 'scale(1.15)');
                }, function () {
                    $('.main-menu .menu-icon').css('transform', 'scale(1)');
                });
                $('.main-menu .menu-icon, .main-menu > span').click(function () {
                    $('.main-menu ul').fadeToggle(300);
                });
            });
        </script>
    </menu>
    <div class="info">
        <section class="company">
            <h2>Про нас</h2>
            <p>Some text to present the conpany</p>
            <p>Some text to present the conpany</p>
            <p>Some text to present the conpany</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany.</p>
        </section>
        <section class="docs">
            <h2>Юридична інформація</h2>
            <figure>
                <img src="images/logo.png" alt="Сертифікат">
                <figcaption>Sertificate or doc to embed</figcaption>
            </figure>
            <figure>
                <img src="images/logo.png" alt="Сертифікат">
                <figcaption>Sertificate or doc to embed</figcaption>
            </figure>
            <figure>
                <img src="images/logo.png" alt="Сертифікат">
                <figcaption>Sertificate or doc to embed</figcaption>
            </figure>
        </section>
        <section class="contacts">
            <h2>Контактна інформація</h2>
            <ul>
                <li class="mail">mail</li>
                <li class="phone">mobile</li>
                <li class="fb">facebook</li>
                <li class="address">address</li>
            </ul>
        </section>
    </div>
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