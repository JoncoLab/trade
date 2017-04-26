<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 03.04.2017
 * Time: 18:33
 */
session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: index.html');
    die();
}
mb_internal_encoding("UTF-8");
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних!');
} else {
    $connection->set_charset('utf8');
    $sellers = explode(',', $_POST["sellers"]);
    $amount = count($sellers);
    $sql = 'SELECT id FROM lots WHERE seller_name=\'' . $sellers[0] . '\'';
    if ($amount > 1) {
        for ($i = 1; $i <= $amount; $i++) {
            $sql .= ' OR seller_name=\'' . $sellers[$i] . '\'';
        }
    }
    $result = $connection->query($sql);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Сесія торгів</title>
    <link href="styles/session.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/session.js"></script>
</head>
<body>
<main>
    <ul class="users"></ul>
    <table class="auction-table"></table>
    <p class="admin-info"></p>
    <button class="add-step">+</button>
    <button class="remove-step">-</button>
    <span class="set-final-cost">
        <label for="set-final-cost">Остаточна: </label>
        <input type="number" id="set-final-cost">
        <button class="raise-to-price"><< Підвищити</button>
    </span>
    <button class="next-lot">Наступний лот</button>
    <button class="previous-lot">Попередній лот</button>
    <button class="end-session">Закінчити сесію</button>
    <span class="set-winner">
        <label for="set-winner">Переможець: </label>
        <input type="text" id="set-winner">
        <button class="set-winner-button"><< Встановити</button>
    </span>
    <ul class="all">
        <?php
        while ($lot = $result->fetch_assoc()) {
            echo '<li class="id">' . $lot["id"] . '</li>';
        }
        ?>
    </ul>
    <div class="chat">
        <div class="messages"></div>
    </div>
</main>
</body>
</html>
<?php
$sql = 'UPDATE trade SET session_active = TRUE';
$connection->query($sql);
$sql = 'INSERT INTO online (trader_id) SELECT trader_id FROM registered WHERE ver=TRUE AND applied_for_lots IS NOT NULL';
$sql = $connection->query($sql);
if ($connection->error) {
    print_r($connection->error_list);
}
$connection->close();
?>