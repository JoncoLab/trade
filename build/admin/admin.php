<?php
include 'scripts/php/user.php';
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
} else {
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="styles/admin-style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="scripts/js/admin-script.js"></script>
</head>
<body>
<header>
    <nav class="navbar">
        <button id="lots">Лоти</button>
        <button id="users">Користувачі</button>
        <button id="write-article">Статті</button>
        <button id="trade">Вести торги</button>
    </nav>
</header>
<main>
    <table class="lots page-maker">
        <thead>
        <tr>
            <th rowspan="2" class="id">Номер лоту</th>
            <th rowspan="2" class="seller-id">Номер продавця</th>
            <th rowspan="2" class="seller-name">Назва продавця</th>
            <th rowspan="2" class="type">Назва асортименту</th>
            <th rowspan="2" class="gost">ГОСТ</th>
            <th rowspan="2" class="breed">Порода</th>
            <th colspan="4">Характеристика</th>
            <th rowspan="2" class="size">Об'єм</th>
            <th rowspan="2" class="cost-start">Ціна за куб</th>
            <th rowspan="2" class="price-start">Вартість лоту</th>
            <th rowspan="2" class="step">Крок ціни</th>
            <th rowspan="2" class="cost-final">Остаточна ціна за куб</th>
            <th rowspan="2" class="customer-number">Номер покупця</th>
            <th rowspan="2" class="price-final">Остаточна вартість</th>
            <th rowspan="2" class="customers-applied">Заявлені учасники</th>
            <th rowspan="2" class="guarantee">Гарантійний внесок</th>
            <th rowspan="2" class="profit">Біржова винагорода</th>
        </tr>
        <tr>
            <th class="characteristics-sort">Гатунок</th>
            <th class="characteristics-diametr">Діаметр</th>
            <th class="characteristics-length">Довжина</th>
            <th class="characteristics-storage">Склад</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = 'SELECT * FROM lots';
        $lots = $connection->query($sql);
        $JSLotsArray = "<script>" .
            "var lots = []; \r\n";
        while ($lot = $lots->fetch_assoc()) {
            $JSLotsArray .= "lots.push({" .
                "sellerName:'" . $lot['seller_name'] .
                "', id:'" . $lot['id'] .
                "', type:'" . $lot['type'] .
                "', characteristicsDiametr:'" . $lot['characteristics_diametr'] .
                "', characteristicsSort:'" . $lot['characteristics_sort'] .
                "', breed:'" . $lot['breed'] .
                "', characteristicsLength:'" . $lot['characteristics_length'] .
                "', characteristicsStorage:'" . $lot['characteristics_storage'] .
                "', gost:'" . $lot['gost'] .
                "', size:'" . $lot['size'] .
                "', customersApplied:'" . $lot['customers_applied'] .
                "', costStart:'" . $lot['cost_start'] .
                "', step:'" . $lot['step'] .
                "'}); \r\n";
            echo
                '<tr>' .
                '<td class="id">' . $lot["id"] . '</td>' .
                '<td class="seller-id">' . $lot["seller_id"] . '</td>' .
                '<td class="seller-name">' . $lot["seller_name"] . '</td>' .
                '<td class="type">' . $lot["type"] . '</td>' .
                '<td class="gost">' . $lot["gost"] . '</td>' .
                '<td class="breed">' . $lot["breed"] . '</td>' .
                '<td class="characteristics-sort">' . $lot["characteristics_sort"] . '</td>' .
                '<td class="characteristics-diametr">' . $lot["characteristics_diametr"] . '</td>' .
                '<td class="characteristics-length">' . $lot["characteristics_length"] . '</td>' .
                '<td class="characteristics-storage">' . $lot["characteristics_storage"] . '</td>' .
                '<td class="size">' . $lot["size"] . '</td>' .
                '<td class="cost-start">' . $lot["cost_start"] . '</td>' .
                '<td class="price-start">' . $lot["price_start"] . '</td>' .
                '<td class="step">' . $lot["step"] . '</td>' .
                '<td class="cost-final">' . $lot["cost-final"] . '</td>' .
                '<td class="customer-number">' . $lot["customer_number"] . '</td>' .
                '<td class="price-final">' . $lot["price_final"] . '</td>' .
                '<td class="customers-applied">' . $lot["customers_applied"] . '</td>' .
                '<td class="guarantee">' . $lot["guarantee"] . '</td>' .
                '<td class="profit">' . $lot["profit"] . '</td>' .
                '</tr>';
        }
        $JSLotsArray .=
            "$('.trade td.seller-name').text(lots[0].sellerName);
                $('.trade td.id').text(lots[0].id);
                $('.trade td.type').text(lots[0].type);
                $('.trade td.characteristics-diametr').text(lots[0].characteristicsDiametr);
                $('.trade td.characteristics-sort').text(lots[0].characteristicsSort);
                $('.trade td.breed').text(lots[0].breed);
                $('.trade td.characteristics-length').text(lots[0].characteristicsLength);
                $('.trade td.characteristics-storage').text(lots[0].characteristicsStorage);
                $('.trade td.gost').text(lots[0].gost);
                $('.trade td.size').text(lots[0].size);
                $('.trade td.customers-applied').text(lots[0].customersApplied);
                $('.trade td.cost-start').text(lots[0].costStart);
                $('.trade td.step').text(lots[0].step);" .
            "</script>"
        ?>
        </tbody>
    </table>
    <table class="users page-maker">
        <thead>
        <tr class="sum">
            <th class="total">Всього: <span id="total"><?php print User::count(); ?></span>
            </th>
            <th class="total-verified">Верифікованих: <span
                    id="total-verified"><?php print User::countVerified(); ?></span>
            </th>
        </tr>
        <tr>
            <th class="id">ID</th>
            <th class="status">Акредитація</th>
            <th class="full-name">Повна назва</th>
            <th class="j-address">Юридична адреса</th>
            <th class="adrpou">ЄДРПОУ</th>
            <th class="ind">Індентифікаційний</th>
            <th class="person">В особі</th>
            <th class="reason">Яка діє на підставі</th>
            <th class="short-name">Скорочена назва</th>
            <th class="head">Директор</th>
            <th class="tel">Телефон</th>
            <th class="email">Логін</th>
            <th class="docs-name">Скорочено для документів</th>
            <th class="post-address">Поштова адреса</th>
            <th class="ver">Стан верифікації</th>
            <th class="trader-id">Номер учасника</th>
            <th class="applied-for-lots">Заявився на лоти</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = 'SELECT * FROM registered';
        $users = $connection->query($sql);
        while ($user = $users->fetch_assoc()) {
            echo
                '<tr>' .
                '<td class="id">' . $user["id"] . '</td>' .
                '<td class="status">' . $user["status"] . '</td>' .
                '<td class="full-name">' . $user["full_name"] . '</td>' .
                '<td class="j-address">' . $user["j-address"] . '</td>' .
                '<td class="edrpou">' . $user["edrpou"] . '</td>' .
                '<td class="ind">' . $user["ind"] . '</td>' .
                '<td class="person">' . $user["person"] . '</td>' .
                '<td class="reason">' . $user["reason"] . '</td>' .
                '<td class="short-name">' . $user["short_name"] . '</td>' .
                '<td class="head">' . $user["head"] . '</td>' .
                '<td class="tel">' . $user["tel"] . '</td>' .
                '<td class="email">' . $user["email"] . '</td>' .
                '<td class="docs-name">' . $user["docs_name"] . '</td>' .
                '<td class="post-address">' . $user["post_address"] . '</td>' .
                '<td class="ver">' . ($user["ver"] === '0' ? 'Не верифікований' : 'Верифікований') . '</td>' .
                '<td class="trader-id">' . $user["trader_id"] . '</td>' .
                '<td class="applied-for-lots">' . $user["applied_for_lots"] . '</td>' .
                '</tr>';
        }
        $connection->close();
        }
            ?>
            </tbody>
        </table>
    <form method="post" class="write-article page-maker">
        <button type="button" class="send-article" style="margin: 0 10px ">Надіслати статтю</button>
        <button type="button" class="watch" style="margin: 10px">Проглянути</button>
        <fieldset class=" header">
            <legend>Введіть заголовок:</legend>
            <input type="text" name="header" placeholder="Mama" id="header" tabindex="1"></fieldset>
        <fieldset class=" content">
            <legend>Напишіть статтю:</legend>
            <textarea rows="10" placeholder="you know what to do.." autofocus tabindex="2"></textarea>
            <button class="add-paragr" type="button">Додати абзац</button>
            <button type="button" class="clear">Очистити</button>
            <br>
        </fieldset>
        <fieldset class=" files">
            <legend>Приєднайте щось до неї:</legend>
            <label>Завантажте файл сюди:
                <input type="file" id="upload-smth" multiple>
                <button class="reset-upload" type="reset">Удалить</button>
            </label>
        </fieldset>
    </form>
    <div class="trade page-maker">
        <button class="start-trade" onclick="startTrade(); $(this).hide();">Почати сесію :(</button>
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
        <?php
        echo $JSLotsArray;
        ?>
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
    </div>
    <div id="loading">Завантаження...</div>
    </main>
</body>

</html>