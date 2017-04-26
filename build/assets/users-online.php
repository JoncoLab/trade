<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 12.04.2017
 * Time: 0:29
 */

mb_internal_encoding("UTF-8");

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$connection->set_charset('utf8');
$sql = 'SELECT customers_applied FROM trade';
$list = $connection->query($sql)->fetch_assoc()["customers_applied"];
if ($list != '') {
    $customers = explode(', ', $connection->query($sql)->fetch_assoc()["customers_applied"]);
    foreach ($customers as $customer) {
        $sql = 'SELECT online FROM online WHERE trader_id=\'' . $customer . '\'';
        $online = $connection->query($sql)->fetch_assoc()["online"];
        if ($online == '1') {
            echo '<li class="user online">' . $customer . '</li>';
        } else {
            echo '<li class="user offline">' . $customer . '</li>';
        }
    }
} else {
    echo '<li class="user offline">Ніхто не заявився!</li>';
}
$connection->close();