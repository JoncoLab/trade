<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 13.12.2016
 * Time: 5:16
 */
session_start();
require_once "user.php";

$email = $_POST["login"];
if ($user = User::getUserByEmail($email)) {
    $_SESSION['id'] = $user->id;
    header("Location: /cabinet.php");
} else {
    die('Помилка підключення до бази даних!');
}
