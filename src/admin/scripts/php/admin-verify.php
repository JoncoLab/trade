<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 16.01.2017
 * Time: 9:19
 */

session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: /index.php');
    die();
}
mb_internal_encoding("UTF-8");

require_once "../../../scripts/php/user.php";

$error =
    "<script>" .
    "alert('Сталася помилка! Сторінку буде перезавантажено!');" .
    "window.location.reload();" .
    "</script>";

if(isset($_POST['id'])) {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $userPassword = '2014';
    $db = 'joncolab_trade';
    $connection = new mysqli($host, $username, $userPassword, $db);

    if ($connection->connect_error) {
        die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
    }
    $connection->set_charset('utf8');
    $sql = 'SELECT * FROM settings';
    $settings = $connection->query($sql)->fetch_assoc();
    $connection->close();
    $id = $_POST['id'];
    $trader_id = $_POST["traderId"];
    User::verify($id, $trader_id);
    $user = User::getUserById($id);
    $verificationStatus = $user->ver;
    $verificationCount = User::countVerified();
    $traderId = $user->trader_id;
    if ($verificationStatus !== '1') {
        echo $error;
    } else {
        echo
        "<script>" .
            "var targetCell = null;" .
            "$('#total-verified').text(" . $verificationCount . ");" .
            "$('.users td.id').each(function () {" .
                "if ($(this).text() === '" . $id . "') {" .
                    "targetCell = $(this);" .
                "}" .
            "});" .
            "targetCell.siblings('.trader-id').text(" . $traderId . ");" .
            "targetCell.siblings('.ver').text('Верифікований');" .
        "</script>";
        $p = "\r\n";
        $to = $user->email;
        $subject = "Верифікація";
        $headers = 'From: EXChange <no-reply@exchange.roik.pro>' . $p;
        $headers .= 'BCC: ' . $settings["to"];
        $message = 'Доброго дня!' . $p . $p;
        $message .= 'Ви успішно пройшли верифікацію на порталі excgange.roik.pro' . $p;
        $message .= 'Вам присвоєно аукціонний номер ' . $trader_id;
        mail($to, $subject, $message, $headers);
    }
}
exit();

