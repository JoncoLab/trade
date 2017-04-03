<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 03.04.2017
 * Time: 18:33
 */

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Сесія торгів</title>
    <link href="styles/session.css">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src=""></script>
</head>
<body>
<main>
    <table class="auction-table">
        <tbody>
        <tr>
            <td class="attribute" colspan="2">Продавець:</td>
            <td class="value seller-name" colspan="7"></td>
        </tr>
        <tr>
            <td class="attribute">Лот №</td>
            <td class="value id"></td>
            <td class="attr-value type" colspan="2"></td>
            <td class="attribute">Діаметр, см:</td>
            <td class="value characteristics-diametr"></td>
            <td class="attribute">Сорт:</td>
            <td class="value characteristics-sort"></td>
            <td class="attribute">ГОСТ</td>
        </tr>
        <tr>
            <td class="attribute">№ ПП в лоті</td>
            <td class="value">-</td>
            <td class="attr-value breed" colspan="2"></td>
            <td class="attribute">Довжина, м:</td>
            <td class="value characteristics-length"></td>
            <td class="attribute">Склад:</td>
            <td class="value characteristics-storage"></td>
            <td class="value gost"></td>
        </tr>
        <tr>
            <td class="attribute">Об'єм лоту, м<sup>3</sup></td>
            <td class="value size" colspan="3"></td>
            <td class="attribute">Учасники:</td>
            <td class="value customers-applied" colspan="4"></td>
        </tr>
        <tr>
            <td class="attribute" colspan="2">Початкова ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>:</td>
            <td class="value cost-start" colspan="2"></td>
            <td class="attribute">Покупець:</td>
            <td class="value customer-number" colspan="2"></td>
            <td class="attribute">Розмір кроку:</td>
            <td class="value step"></td>
        </tr>
        <tr>
            <td class="attribute" colspan="2">Остаточна ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>:</td>
            <td class="value cost-final" colspan="2"></td>
            <td class="attribute">Остаточна вартість, <sup>грн.</sup>/<sub>лот</sub>:</td>
            <td class="value price-final" colspan="2"></td>
            <td class="attribute">Крок:</td>
            <td class="value current-step">0</td>
        </tr>
        </tbody>
    </table>
    <p class="admin-info"></p>
    <button class="add-step">+</button>
    <button class="remove-step">-</button>
    <span class="set-final-cost">
            <label for="set-final-cost">Остаточна: </label>
            <input type="number" id="set-final-cost">
            <button><< Підвищити</button>
        </span>
    <button class="next-lot">Наступний лот</button>
    <button class="previous-lot">Попередній лот</button>
    <button class="end-trade">Закінчити сесію</button>
</main>
</body>
</html>
