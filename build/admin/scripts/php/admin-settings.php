<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 26.04.2017
 * Time: 3:54
 */

session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: /index.php');
    die();
}
mb_internal_encoding("UTF-8");

if (isset($_POST["function"])) {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $password = '2014';
    $db = 'joncolab_trade';

    $connection = new mysqli($host, $username, $password, $db);
    if ($connection->connect_error) {
        die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
    }
    $connection->set_charset('utf8');

    switch ($_POST["function"]) {
        case 'nextSession':
            $nextSession = $_POST["input"];
            $dateTime = explode('T', $nextSession);
            $dateElements = explode('-', $dateTime[0]);
            $date = $dateElements[2] . '.' . $dateElements[1] . '.' . $dateElements[0];
            $time = $dateTime[1];
            $nextSession = $time . ' ' . $date;
            $sql = 'UPDATE settings SET next_session=\'' . $nextSession . '\'';
            $connection->query($sql);
            break;
        case 'adminPass':
            $adminPass = $_POST["input"];
            $sql = 'UPDATE settings SET admin_password=\'' . $adminPass . '\'';
            $connection->query($sql);
            break;
        case 'timer':
            $timer = $_POST["input"];
            $sql = 'UPDATE settings SET timer=\'' . $timer . '\'';
            $connection->query($sql);
            break;
        case 'to':
            $to = $_POST["input"];
            $sql = 'UPDATE settings SET `to`=\'' . $to . '\'';
            $connection->query($sql);
            break;
    }
    $connection->close();
    exit();
}