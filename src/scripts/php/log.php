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
    $_SESSION['id'] = $user->id;
    $_SESSION['status'] = $user->status;
    $_SESSION['full_name'] = $user->full_name;
    $_SESSION['j_address'] = $user->j_address;
    $_SESSION['edrpou'] = $user->edrpou;
    $_SESSION['ind'] = $user->ind;
    $_SESSION['person'] = $user->person;
    $_SESSION['reason'] = $user->reason;
    $_SESSION['short_name'] = $user->short_name;
    $_SESSION['tel'] = $user->tel;
    $_SESSION['email'] = $user->email;
    $_SESSION['docs_name'] = $user->docs_name;
    $_SESSION['post_address'] = $user->post_address;
    $_SESSION['ver'] = $user->ver;
    $_SESSION['trader_id'] = $user->trader_id;
    $_SESSION['applied_for_lots'] = $user->applied_for_lots;
    header("Location: /cabinet.php");
} else {
    die('Помилка підключення до бази даних!');
}
