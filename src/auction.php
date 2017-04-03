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
    <script src="scripts/js/script.js"></script>
    <script src="scripts/js/auction.js"></script>
</head>

<body>
<div id="fullscreen">
    <h1>Для зручності вікно буде розгорнуто на повний екран</h1>
    <button class="fullscreen">ОК</button>
</div>
    <header>
        //= modules/menu.html
        //= modules/logo.html
    </header>
    <main>
        <section class="info">
            <div class="stream">
                <iframe width="460" height="315" src="https://www.youtube.com/embed/vVG-YcshwAw" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="chat">
                <h2>Повідомлення адміністратора торгу</h2>
                <div class="messages">
                    <p class="message"><img src="SVG/alarm.svg"><span>Лот 123 продано 555</span></p>
                    <p class="message"><img src="SVG/alarm.svg"><span>Торгується лот 456</span></p>
                    <p class="message"><img src="SVG/alarm.svg"><span>лот 456 продано 505</span></p>
                    <p class="message"><img src="SVG/alarm.svg"><span>Торгується лот 222</span></p>
                    <p class="message"><img src="SVG/alarm.svg"><span>Лот 222 продано 505</span></p>
                    <p class="message"><img src="SVG/alarm.svg"><span>Торгується лот 178</span></p>
                    <p class="message"><img src="SVG/alarm.svg"><span>Лот 178 продано 286</span></p>
                </div>
            </div>
        </section>
        <section class="trade">
            <table class="auction-table">
                <tbody>
                <tr>
                    <td class="attribute" colspan="2">Продавець:</td>
                    <td class="value" colspan="7">ДП "Великобичківське ЛМГ"</td>
                </tr>
                <tr>
                    <td class="attribute">Лот №</td>
                    <td class="value">150</td>
                    <td class="attr-value" colspan="2">Пиловник</td>
                    <td class="attribute">Діаметр, см:</td>
                    <td class="value">14-25</td>
                    <td class="attribute">Сорт:</td>
                    <td class="value">1</td>
                    <td class="attribute">ГОСТ</td>
                </tr>
                <tr>
                    <td class="attribute">№ ПП в лоті</td>
                    <td class="value">-</td>
                    <td class="attr-value" colspan="2">бук</td>
                    <td class="attribute">Довжина, м:</td>
                    <td class="value">1-6</td>
                    <td class="attribute">Склад:</td>
                    <td class="value">верхній</td>
                    <td class="value">9462-88</td>
                </tr>
                <tr>
                    <td class="attribute">Об'єм лоту, м<sup>3</sup></td>
                    <td class="value" colspan="3">50</td>
                    <td class="attribute">Учасники:</td>
                    <td class="value" colspan="4">480, 505, 183</td>
                </tr>
                <tr>
                    <td class="attribute" colspan="2">Початкова ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>:</td>
                    <td class="value" colspan="2">915</td>
                    <td class="attribute">Покупець:</td>
                    <td class="value" colspan="2">505</td>
                    <td class="attribute">Розмір кроку:</td>
                    <td class="value">20</td>
                </tr>
                <tr>
                    <td class="attribute" colspan="2">Остаточна ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>:</td>
                    <td class="value" colspan="2">955</td>
                    <td class="attribute">Остаточна вартість, <sup>грн.</sup>/<sub>лот</sub>:</td>
                    <td class="value" colspan="2">47750</td>
                    <td class="attribute">Крок:</td>
                    <td class="value">54</td>
                </tr>
                </tbody>
            </table>
            <div class="actions">
                <form class="leave">
                    <input type="submit" name="leave" class="leave-button" value="Не торгуватися">
                </form>
                <form class="raise steps">
                    <div class="fieldset">
                        <label for="raise-by-steps">Підвищити на </label>
                        <input type="number" name="raise-by-steps" id="raise-by-steps" min="1" max="100" step="1" required placeholder="17">
                        <label for="raise-by-steps">крок(-ів)</label>
                    </div>
                    <label for="submit-steps">Підтвердити</label>
                    <input type="submit" name="submit-steps" id="submit-steps">
                </form>
                <form class="raise amount">
                    <div class="fieldset">
                        <label for="raise-by-amount">Підвищити на </label>
                        <input type="number" name="raise-by-amount" id="raise-by-amount" min="10000" max="1000000" step="10000" required placeholder="17">
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