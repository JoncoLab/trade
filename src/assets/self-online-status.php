<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 26.04.2017
 * Time: 16:55
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
$sql = "SELECT online from online WHERE trader_id='" . $_POST["trader_id"] . "' AND online=TRUE";
$online = $connection->query($sql)->num_rows > 0;
$sql = 'SELECT customers_applied FROM trade';
$applied = in_array($_POST["trader_id"], explode(', ', $connection->query($sql)->fetch_assoc()["customers_applied"]));
$connection->close();
echo $applied ? ($online ? 'Торгується' : 'Не торгується') : 'Не заявлений';