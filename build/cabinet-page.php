<?php
session_start();
include('scripts/php/user.php');
$user = User::getUserById($_SESSION["id"]);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Trade</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/cabinet-page.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/script.js"></script>
    <script src="scripts/js/cabinet.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Логотип">
            <h1>Назва компанії</h1>
        </div>
        <!--<div class="reg-log">-->
            <!--<button class="login">Увійти</button>-->
            <!--<button class="signup">Зареєструватися</button>-->
            <!--<dialog class="login" open>-->
                <!--<form class="login-form">-->
                    <!--<label for="login">Ваш логін:</label>-->
                    <!--<input required type="email" name="login" id="login" placeholder="Ваш логін (ел. пошта)" autocomplete="on">-->
                    <!--<label for="password-in">Ваш пароль:</label>-->
                    <!--<input required type="password" name="password-in" id="password-in" placeholder="Ваш пароль" required>-->
                    <!--<label for="remember">-->
                        <!--<div class="checkbox"></div><span>Запам'ятати мене</span> </label>-->
                    <!--<input type="checkbox" id="remember" name="remember" checked>-->
                    <!--<input type="submit" value="Увійти до кабінету">-->
                <!--</form>-->
                <!--<script>-->
                    <!--$(document).ready(function () {-->
                        <!--$('button.login').click(function () {-->
                            <!--$('dialog.login').fadeToggle(300);-->
                        <!--});-->
                        <!--$('label[for="remember"]').click(function () {-->
                            <!--$(this).children('.checkbox').toggleClass('checked');-->
                        <!--});-->
                    <!--});-->
                <!--</script>-->
            <!--</dialog>-->
            <!--<dialog class="signup"></dialog>-->
        <!--</div>-->
    </header>
    <main>
        <menu class="main-menu"> <img class="menu-icon" src="SVG/menu.svg"> <span>Меню</span>
            <ul class="menu">
                <li><img class="ico" src="SVG/user-light.svg"><a href="cabinet-page.php">Мій кабінет</a></li>
                <li><img class="ico" src="SVG/hammer2-light.svg"><a href="lots.php">Наявні лоти</a></li>
                <li><img class="ico" src="SVG/office-light.svg"><a href="about.html">Про компанію</a></li>
                <li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.html">Новини проекту</a></li>
                <li><img class="ico" src="SVG/book-light.svg"><a href="rules.html">Правила та умови</a></li>
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
        <div class="cabinet-content">
            <div class="layout">
                <section class="my-info">
                    <h2>Ваші дані</h2>
                    <ul>
                        <li class="name"><?php print $user->name;?></li>
                        <li class="number"><?php print $user->number;?></li>
                        <li class="mail"><?php print $user->email;?></li>
                        <li class="registration-date" title="Дата реєстрації">21.01.2017</li>
                    </ul>
                    <button class="add-docs">Додати документи</button>
                    <div class='user-id'>Ваш User id: <span id="user-id"><?php print $user->id?></span></div>
                </section>
                <section class="access">
                    <h2>Доступ до торгів</h2>
                    <a href="auction.html" class="auction">Перейти до аукціону</a>
                    <ul class="accessable">
                        <li><span class="lot-num">Номер лоту: <strong id="drag1" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag2" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag3" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag4" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag5" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag6" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag7" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                    </ul>
                </section>
            </div>
            <section class="load-docs">
                <div id="drop-files" ondrop="event.preventDefault(); event.stopPropagation(); doDrop(event);"></div>
                <div class="actions">
                    <label for="files">Виберіть файли з комп'ютера</label>
                    <input type="file" name="files" id="files" value="Завантажити" form="send-docs" accept="" multiple required>
                    <label for="reset">Очистити</label>
                    <input type="reset" name="reset" id="reset" value="Очистити" form="send-docs">
                </div>
                <form method="post" id="send-docs" name="send-docs">
                    <label for="submit">Прикріпити та надіслати завантажені документи</label>
                    <input type="submit" name="submit" id="submit" value="Прикріпити та надіслати завантажені документи">
                </form>
            </section>
        </div>
        <form action="scripts/php/mail.php" method="post" class="feedback-form" id="feedback">
            <label for="name">Ваше ім'я</label>
            <input type="text" name="name" id="name" placeholder="Семен" required autofocus>
            <label for="email">Ваша електронна адреса</label>
            <input type="email" name="email" id="email" placeholder="zrazok@joncolab.pro" required>
            <label for="message">Ваш коментар</label>
            <textarea rows="5" placeholder="Введіть ваше повідомлення" maxlength="1000" id="text" name="message" id="message" required></textarea>
            <fieldset class="buttons">
                <label for="reset">Очистити</label>
                <input type="reset" id="reset" name="reset" value="Очистити">
                <label for="submit">Надіслати</label>
                <input type="submit" id="submit" name="submit" value="Надіслати">
            </fieldset>
        </form>
    </main>
    <footer>
        <a class="contacts footer-item" href="about.html"> <span>Наші контактні дані:</span>
            <br> <img class="contacts-logo" src="SVG/address-book-light.svg"> </a>
        <div class="feedback footer-item"> <span>Залиште свій відгук!</span>
            <br> <img src="SVG/bubbles-light.svg" class="feedback-logo"> </div>
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