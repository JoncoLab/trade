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
</head>

<body>
    <header>
        <menu class="main-menu"> <img class="menu-icon" src="SVG/menu.svg"> <span>Меню</span>
            <ul class="menu">
                <li><img class="ico" src="SVG/user-light.svg"><a href="cabinet-page.php">Мій кабінет</a></li>
                <li><img class="ico" src="SVG/hammer2-light.svg"><a href="auction.php">Аукціон</a></li>
                <li><img class="ico" src="SVG/office-light.svg"><a href="../about.php">Про компанію</a></li>
                <li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.php">Новини проекту</a></li>
                <li><img class="ico" src="SVG/book-light.svg"><a href="../rules.php">Правила та умови</a></li>
                <li><img class="ico" src="SVG/doc-light.svg"><a href="application.php">Подати заявку на участь в торгах</a></li>
                <li><img class="ico" src="SVG/archive-light.svg"><a href="archive.php">Архів заявок</a></li>
                <li><img class="ico" src="SVG/exit-light.svg"><a href="../scripts/php/logout.php">Вихід</a></li>
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
        <div class="logo">
            <img src="images/logo.png" alt="Логотип">
            <h1>EXChange</h1>
        </div>
    </header>
    <main>
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
                <td class="attribute" colspan="2">Початкова ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>, в т.ч. ПДВ:</td>
                <td class="value" colspan="2">915</td>
                <td class="attribute">Покупець:</td>
                <td class="value" colspan="2">505</td>
                <td class="attribute">Розмір кроку:</td>
                <td class="value">20</td>
            </tr>
            <tr>
                <td class="attribute" colspan="2">Остаточна ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>, в т.ч. ПДВ:</td>
                <td class="value" colspan="2">955</td>
                <td class="attribute">Остаточна вартість, <sup>грн.</sup>/<sub>лот</sub>, в т.ч. ПДВ:</td>
                <td class="value" colspan="2">47750</td>
                <td class="attribute">Крок:</td>
                <td class="value">54</td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="9" class="name">Наступні лоти:</td>
            </tr>
            <tr>
                <td class="attribute">Лот №</td>
                <td class="value">151</td>
                <td class="attribute">Об'єм:</td>
                <td class="value">50</td>
                <td class="attribute">Учасники:</td>
                <td class="value" colspan="4">345, 715</td>
            </tr>
            <tr>
                <td class="attribute">Лот №</td>
                <td class="value">152</td>
                <td class="attribute">Об'єм:</td>
                <td class="value">50</td>
                <td class="attribute">Учасники:</td>
                <td class="value" colspan="4">350, 505</td>
            </tr>
            <tr>
                <td class="attribute">Лот №</td>
                <td class="value">153</td>
                <td class="attribute">Об'єм:</td>
                <td class="value">100</td>
                <td class="attribute">Учасники:</td>
                <td class="value" colspan="4">505, 715</td>
            </tr>
            </tfoot>
        </table>
        <section class="actions">
            <form class="leave">
                <button class="leave-button">Покинути торги</button>
                <dialog class="leave-dialog">
                    <p>Are you sure?</p>
                    <label for="leave">Здатися</label>
                    <input type="submit" name="leave" id="leave">
                    <button class="cancel-button">Скасувати</button>
                </dialog>
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
        </section>
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