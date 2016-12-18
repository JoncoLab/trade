<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 13.12.2016
 * Time: 5:16
 */
session_start();
include('user.php');

if ($connection->connect_error) {
    die ('Не вдається встановити підключення до бази даних:\r\n' . $connection->connect_error);
} else {
    $email = trim($_POST["login"]);
    $user = User::getUserByEmail($email);
    $_SESSION["id"] = $user->id;
    header("Location: /cabinet-page.php");
}