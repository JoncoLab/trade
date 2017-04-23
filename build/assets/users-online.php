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
$sql = 'SELECT * FROM online';
$customers = $connection->query($sql);
$connection->close();
while ($customer = $customers->fetch_assoc()) {
    if ($customer["online"] == '1') {
        echo '<li class="user online">' . $customer["id"] . '</li>';
    } else {
        echo '<li class="user offline">' . $customer["id"] . '</li>';
    }
}