<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 13.12.2016
 * Time: 5:16
 */
session_start();
include('user.php');

$email = trim($_POST["login"]);
if ($user = User::getUserByEmail($email)) {
    $_SESSION["id"] = $user->id;
    $_SESSION['email'] = $user->email;
    $_SESSION['full_name'] = $user->full_name;
    $_SESSION['j_address'] = $user->j_address;
    $_SESSION['tel'] = $user->tel;
    $_SESSION['edrpou'] = $user->edrpou;
    $_SESSION['docs_name'] = $user->docs_name;
    $_SESSION['ver'] = $user->ver;
    header("Location: /cabinet-page.php");
} else {
    die('Помилка підключення до бази даних!');
}