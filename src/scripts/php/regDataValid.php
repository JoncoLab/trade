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
$db = 'jonco_trade';
$connection = new mysqli($host, $username, $password, $db);

if ($connection->connect_error) {
    echo 'Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error;
} else {
    $type = $_POST["type"];
    $value = $_POST["value"];
    switch ($type) {
        case 'number':
            $sql = "SELECT number FROM registered WHERE number='" . $value . "'";
            break;
        case 'address':
            $sql = "SELECT address FROM registered WHERE address='" . $value . "'";
            break;
        case 'email':
            $sql = "SELECT email FROM registered WHERE email='" . $value . "'";
            break;
        default:
            echo 'error';
    }
    $result = $connection->query($sql);
    $rows = $result->num_rows;

    if ($rows > 0) {
        $permitted = false;
    }
    $connection->close();
    echo $permitted ? 'permitted' : 'denied';
    exit();
}