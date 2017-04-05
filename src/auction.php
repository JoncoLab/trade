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
    <button class="fullscreen">ОК</button>
</div>
    <header>
        //= modules/menu.html
        //= modules/logo.html
    </header>
    <main>
        <section class="info">
            <div class="stream">
                <iframe width="460" height="315" src="https://www.youtube.com/embed/vVG-YcshwAw" frameborder="0"></iframe>
            </div>
            <div class="chat">
                <h2>Повідомлення адміністратора торгу</h2>
                <div class="messages">
<!--                    <p class="message"><img src="SVG/alarm.svg"><span>Лот 123 продано 555</span></p>-->
                </div>
            </div>
        </section>
        <section class="trade">
            <table class="auction-table"></table>
            <div class="actions">
                <form class="leave">
                    <input type="submit" name="leave" class="leave-button" value="Не торгуватися">
                </form>
                <form class="raise steps">
                    <div class="fieldset">
                        <label for="raise-by-steps">Підвищити на </label>
                        <input type="number" name="raise-by-steps" id="raise-by-steps" min="1" max="100" step="1" required>
                        <label for="raise-by-steps">крок(-ів)</label>
                    </div>
                    <label for="submit-steps">Підтвердити</label>
                    <input type="submit" name="submit-steps" id="submit-steps">
                </form>
                <form class="raise amount">
                    <div class="fieldset">
                        <label for="raise-by-amount">Підвищити на </label>
                        <input type="number" name="raise-by-amount" id="raise-by-amount" min="10" max="10000" step="10" required>
                        <label for="raise-by-amount">грн.</label>
                    </div>
                    <label for="submit-amount">Підтвердити</label>
                    <input type="submit" name="submit-amount" id="submit-amount">
                </form>
            </div>
        </section>
    </main>
</body>
</html>