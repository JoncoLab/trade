<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 07.12.2016
 * Time: 2:07
 */
session_start();
mb_internal_encoding('UTF-8');
require_once "user.php";
$errors = null;
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $password, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
} else {
    $connection->set_charset('utf8');
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $address = $_POST["address"];
    $sql = 'SELECT id FROM registered';
    $result = $connection->query($sql);
    while ($id = $result->fetch_assoc()["id"]) {
        $user = User::getUserById($id);
        $errors = ($user->full_name == $name ?
            'name' :
            ($user->email == $email ?
                'email' :
                ($user->tel == $number ?
                    'number' :
                    ($user->j_address == $address ?
                        'address' :
                        'valid'))));
        if ($errors != 'valid') {
            break;
        }
    }
    $connection->close();
    echo $errors;
}