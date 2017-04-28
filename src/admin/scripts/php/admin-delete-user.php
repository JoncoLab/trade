<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 10.04.2017
 * Time: 10:59
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
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$id = $_POST["userId"];
$connection->set_charset('utf8');
$sql = "DELETE FROM registered WHERE id='" . $id . "'";
$connection->query($sql);
$connection->close();
exit();