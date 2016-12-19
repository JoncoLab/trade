<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 13.12.2016
 * Time: 5:16
 */
session_start();
include('user.php');

$number = trim($_POST["number"]);
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
$name = trim($_POST["company-name"]);
$address =
    trim($_POST["zip"]) . ', ' .
    trim($_POST["country"]) . ', ' .
    trim($_POST["region"]) . ' область, ' .
    trim($_POST["district"]) . ' район, ' .
    trim($_POST["city"]) . ', вул. ' .
    trim($_POST["street"]) . ', ' .
    trim($_POST["streetnum"]) . '/' .
    trim($_POST["doornum"]);

$user = User::registerUser($email, $password, $name, $number, $address);
$_SESSION["id"] = $user->id;
header("Location: /cabinet-page.php");