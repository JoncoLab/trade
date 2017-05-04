<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 01.05.2017
 * Time: 7:30
 */

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$sql = 'SELECT seconds_left FROM trade';
$sec = $connection->query($sql)->fetch_assoc()["seconds_left"];
echo '00:' . ($sec > 9 ? $sec : ('0' . $sec));
$connection->close();