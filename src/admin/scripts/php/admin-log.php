<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 16.01.2017
 * Time: 7:36
 */

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$connection->set_charset('utf8');
$sql = 'SELECT admin_password FROM settings';
$pass = $connection->query($sql)
    ->fetch_assoc()["admin_password"];
echo $_POST["pass"] === $pass ? '+' : '-';
exit();