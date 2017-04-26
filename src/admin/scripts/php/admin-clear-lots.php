<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 26.04.2017
 * Time: 7:51
 */

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$sql = 'TRUNCATE TABLE lots';
$connection->query($sql);
exit();