<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 07.12.2016
 * Time: 2:07
 */

$permitted = true;
$host = 'joncolab.mysql.ukraine.com.ua' ;
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $password, $db);

if ($connection->connect_error) {
    echo 'Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error;
} else {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $sql = "SELECT email, password FROM registered WHERE email='" . $login . "' AND password='" . $password . "'";
    $result = $connection->query($sql);

    if ($result->num_rows !== 1) {
        $permitted = false;
    }
    $connection->close();
    echo $permitted ? 'permitted' : 'denied';
    exit();
}