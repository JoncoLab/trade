<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 27.04.2017
 * Time: 1:44
 */

session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: /index.php');
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
$connection->set_charset('utf8');
$sql = 'UPDATE registered SET ver=FALSE, trader_id=NULL, applied_for_lots=NULL, access=FALSE';
$connection->query($sql);
$sql = 'UPDATE lots SET customers_applied=NULL';
$connection->query($sql);
$connection->close();
exit();