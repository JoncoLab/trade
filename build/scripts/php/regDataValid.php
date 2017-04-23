<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 07.12.2016
 * Time: 2:07
 */

$permitted = false;
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $password, $db);

if ($connection->connect_error) {
    echo 'Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error;
} else {
    $connection->set_charset('utf8');
    $type = $_POST["type"];
    $value = $_POST["value"];
    switch ($type) {
        case 'number':
            $sql = "SELECT tel FROM registered WHERE tel='" . $value . "'";
            break;
        case 'address':
            $sql = "SELECT `j-address` FROM registered WHERE `j-address`='" . $value . "'";
            break;
        case 'email':
            $sql = "SELECT email FROM registered WHERE email='" . $value . "'";
            break;
        case 'name':
            $sql = "SELECT full_name FROM registered WHERE full_name='" . $value . "'";
            break;
        default:
            echo 'error';
    }
    $result = $connection->query($sql);
    $rows = $result->num_rows;

    if ($rows == 0) {
        $permitted = true;
    }
    $connection->close();
    echo $permitted ? 'permitted' : 'denied';
}