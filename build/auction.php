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
    <title>EXChange - торги</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/auction.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js"></script>
    <script src="scripts/js/auction.js"></script>
</head>

<body>
<div id="fullscreen">
    <h1>Для зручності буде відкрито повноекранний режим</h1>
    <button class="fullscreen" autofocus>ОК</button>
</div>
    <header>
        <menu class="main-menu" xmlns="http://www.w3.org/1999/html">
            <img class="menu-icon" src="SVG/menu.svg">
            <span>Меню</span>
            <ul class="menu">
                <li><img class="ico" src="SVG/user-light.svg"><a href="../cabinet.php">Мій кабінет</a></li>
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
        <div class="clock"></div>
    </header>
    <main>
        <section class="info">
            <div class="stream">
                <iframe width="460" height="315" src="https://www.youtube.com/embed/vVG-YcshwAw" frameborder="0"></iframe>
            </div>
            <div class="chat">
                <h2>Повідомлення адміністратора торгу</h2>
                <div class="messages">
                    <div class="wrapper"></div>
                </div>
            </div>
            <div class="trader-id" style="display: none"><?php print $_SESSION["trader_id"];?></div>
        </section>
        <section class="trade">
            <table class="auction-table"></table>
            <div class="actions">
                <div class="action leave">
                    <button class="leave">Не торгуватися</button>
                </div>
                <div class="action raise steps">
                    <div class="fieldset">
                        <label for="raise-to-steps">Підвищити  ще на </label>
                        <input type="number" name="raise-to-steps" id="raise-to-steps" min="1" max="100" step="1">
                        <label for="raise-to-steps">крок(-ів)</label>
                    </div>
                    <button class="raise-to-steps">Підтвердити</button>
                </div>
                <div class="action raise amount">
                    <div class="fieldset">
                        <label for="raise-to-amount">Підвищити до </label>
                        <input type="number" name="raise-to-amount" id="raise-to-amount" min="" max="10000" step="10">
                        <label for="raise-to-amount">грн.</label>
                    </div>
                    <button class="raise-to-price">Підтвердити</button>
                </div>
            </div>
        </section>
    </main>
</body>
</html>