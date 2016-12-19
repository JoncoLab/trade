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
$user = User::getUserByEmail($email);
$_SESSION["id"] = $user->id;
header("Location: /cabinet-page.php");
