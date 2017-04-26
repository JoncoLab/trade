<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 26.04.2017
 * Time: 3:54
 */

if (isset($_POST["next_session"])) {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $password = '2014';
    $db = 'joncolab_trade';

    $connection = new mysqli($host, $username, $password, $db);
    if ($connection->connect_error) {
        die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
    }
    $connection->set_charset('utf8');
    $nextSession = $_POST["next_session"];
    $dateTime = explode('T', $nextSession);
    $dateElements = explode('-', $dateTime[0]);
    $date = $dateElements[1] . '.' . $dateElements[2] . '.' . $dateElements[0];
    $time = $dateTime[1];
    $nextSession = $time . ' ' . $date;
    $sql = 'UPDATE settings SET next_session=\'' . $nextSession . '\'';
    $connection->query($sql);
    $connection->close();
    exit();
}