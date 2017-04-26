<?php
session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: index.html');
    die();
}
mb_internal_encoding("UTF-8");
include '../scripts/php/user.php';
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
} else {
    $connection->set_charset('utf8');
    ?>
    <!DOCTYPE html>
    <html lang="uk">
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <link href="styles/admin.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="scripts/js/jquery-3.1.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="scripts/js/admin.js"></script>
    </head>
    <body>
    <header>
        <nav class="navbar">
            <button id="settings">Загальне адміністрування</button>
            <button id="lots">Лоти</button>
            <button id="users">Користувачі</button>
<!--            <button id="write-article">Статті</button>-->
            <button id="trade">Вести торги</button>
        </nav>
    </header>
    <main>
        <section class="settings page-maker">
            <?php
            $sql = 'SELECT * FROM settings';
            $settings = $connection->query($sql)
                ->fetch_assoc();
            ?>
            <form method="post" id="set-next-session">
                <label for="next-session">Наступна сесія: </label>
                <input type="datetime-local" name="next-session" id="next-session" required>
                <button type="submit" id="next-session-submit">Підтвердити</button>
            </form>
            <form method="post" id="set-admin-pass">
                <label for="admin-pass">Пароль адміністратора: </label>
                <input type="text" name="admin-pass" id="admin-pass" placeholder="<?php print $settings["admin_password"];?>" required>
                <button type="submit" id="admin-pass-submit">Підтвердити</button>
            </form>
            <form method="post" id="upload-application">
                <label for="application-template">Завантажити шаблон заявки</label>
                <input type="file" accept=".xlsx" id="application-template" name="application-template">
            </form>
            <form method="post" id="upload-letter">
                <label for="letter-template">Завантажити шаблон листа</label>
                <input type="file" accept=".docx, .doc" id="letter-template" name="letter-template">
            </form>
            <form method="post" id="upload-personal-data-usage-agreement">
                <label for="personal-data-usage-agreement-template">Завантажити шаблон заяви-погодження на обробку персональних даних</label>
                <input type="file" accept=".docx, .doc" id="personal-data-usage-agreement-template" name="personal-data-usage-agreement-template">
            </form>
        </section>
        <table class="lots page-maker">
            <thead>
            <tr>
                <th colspan="6">
                    <form id="upload-lots">
                        <label for="upload">Завантажити бюлетень для формування таблиці лотів</label>
                        <input type="file" accept=".xlsx" id="upload" name="lots">
                    </form>
                </th>
                <th colspan="5">
                    <div id="clear-lots">
                        <span id="clear">Очистити таблицю лотів</span>
                    </div>
                </th>
            </tr>
            <tr>
                <th rowspan="2" class="delete"></th>
                <th rowspan="2" class="id">Номер лоту</th>
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
                <th rowspan="2" class="seller-id">Номер продавця</th>
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
            $sellers = array();
            while ($lot = $lots->fetch_assoc()) {
                echo
                    '<tr>' .
                    '<td class="delete"><button class="delete-button">Видалити лот</button></td>' .
                    '<td class="id">' . $lot["id"] . '</td>' .
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
                    '<td class="cost-final">' . $lot["cost_final"] . '</td>' .
                    '<td class="customer-number">' . $lot["customer_number"] . '</td>' .
                    '<td class="price-final">' . $lot["price_final"] . '</td>' .
                    '<td class="seller-id">' . $lot["seller_id"] . '</td>' .
                    '<td class="customers-applied">' . $lot["customers_applied"] . '</td>' .
                    '<td class="guarantee">' . $lot["guarantee"] . '</td>' .
                    '<td class="profit">' . $lot["profit"] . '</td>' .
                    '</tr>';

                if (in_array($lot["seller_name"], $sellers) === false) {
                    array_push($sellers, $lot["seller_name"]);
                }
            }
            ?>
            </tbody>
        </table>
        <table class="users page-maker">
            <thead>
            <tr class="sum">
                <th class="total">Всього:
                    <span id="total"><?php print User::count();?></span>
                </th>
                <th class="total-verified">Верифікованих:
                    <span id="total-verified"><?php print User::countVerified();?></span>
                </th>
                <th>
                    <div id="cancel-all-verifications">
                        <span id="cancel">Анулювати всі верифікації</span>
                    </div>
                </th>
            </tr>
            <tr>
                <th class="delete"></th>
                <th class="id">ID</th>
                <th class="status">Акредитація</th>
                <th class="full-name">Повна назва</th>
                <th class="j-address">Юридична адреса</th>
                <th class="adrpou">ЄДРПОУ</th>
                <th class="ind">ідентифікаційний</th>
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
            $sql = 'SELECT id FROM registered';
            $users = $connection->query($sql);
            while ($userId = $users->fetch_assoc()) {
                $user = User::getUserById($userId["id"]);
                echo
                    '<tr>' .
                    '<td class="delete"><button class="delete-button">Видалити користувача</button><button class="cancel-verification-button">Анулювати верифікацію</button></td>' .
                    '<td class="id">' . $user->id . '</td>' .
                    '<td class="status">' . $user->status . '</td>' .
                    '<td class="full-name">' . $user->full_name . '</td>' .
                    '<td class="j-address">' . $user->j_address . '</td>' .
                    '<td class="edrpou">' . $user->edrpou . '</td>' .
                    '<td class="ind">' . $user->ind . '</td>' .
                    '<td class="person">' . $user->person . '</td>' .
                    '<td class="reason">' . $user->reason . '</td>' .
                    '<td class="short-name">' . $user->short_name . '</td>' .
                    '<td class="head">' . $user->head . '</td>' .
                    '<td class="tel">' . $user->tel . '</td>' .
                    '<td class="email">' . $user->email . '</td>' .
                    '<td class="docs-name">' . $user->docs_name . '</td>' .
                    '<td class="post-address">' . $user->post_address . '</td>' .
                    '<td class="ver">' .
                    (($user->ver === '0') ? (
                        '<form class="verification-form">' .
                        '<input type="text" name="set-trader-id" class="set-trader-id" maxlength="4" pattern="[0-9]{3}" placeholder="Реєстр. №">' .
                        '<label class="verify">Верифікувати<input style="display: none;" type="submit" name="submit" value="verify"></label>' .
                        '</form>'
                    ) : 'Верифікований') .
                    '</td>' .
                    '<td class="trader-id">' . $user->trader_id . '</td>' .
                    '<td class="applied-for-lots">' . $user->applied_for_lots . '</td>' .
                    '</tr>';
            }
            ?>
            </tbody>
        </table>
<!--        <form method="post" class="write-article page-maker">-->
<!--            <button type="button" class="send-article" style="margin: 0 10px ">Надіслати статтю</button>-->
<!--            <button type="button" class="watch" style="margin: 10px">Проглянути</button>-->
<!--            <fieldset class=" header">-->
<!--                <legend>Введіть заголовок:</legend>-->
<!--                <input type="text" name="header" placeholder="Mama" id="header" tabindex="1"></fieldset>-->
<!--            <fieldset class=" content">-->
<!--                <legend>Напишіть статтю:</legend>-->
<!--                <textarea rows="10" placeholder="you know what to do.." autofocus tabindex="2"></textarea>-->
<!--                <button class="add-paragr" type="button">Додати абзац</button>-->
<!--                <button type="button" class="clear">Очистити</button>-->
<!--                <br>-->
<!--            </fieldset>-->
<!--            <fieldset class=" files">-->
<!--                <legend>Приєднайте щось до неї:</legend>-->
<!--                <label>Завантажте файл сюди:-->
<!--                    <input type="file" id="upload-smth" multiple>-->
<!--                    <button class="reset-upload" type="reset">Удалить</button>-->
<!--                </label>-->
<!--            </fieldset>-->
<!--        </form>-->
        <form class="trade page-maker" action="session.php" method="post">
            <fieldset>
                <legend>Наступна сесія:</legend>
                <?php
                foreach ($sellers as $seller) {
                    echo
                        '<label class="form-item">' .
                        '<span class="seller">' . $seller . '</span>' .
                        '<input type="checkbox">' .
                        '</label>';
                }
                ?>
            </fieldset>
            <input type="submit" id="start-session-submit" name="start-session-submit">
            <label for="start-session-submit">Почати</label>
            <input type="hidden" id="sellers" name="sellers">
        </form>
        <div id="loading">Завантаження...</div>
    </main>
    </body>

    </html>
    <?php
    $connection->close();
}
?>