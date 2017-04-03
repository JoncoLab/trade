<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 16.01.2017
 * Time: 9:19
 */

include '../../../scripts/php/user.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $trader_id = $_POST["traderId"];
    User::verify($id, $trader_id);
    $user = User::getUserById($id);
    $verificationStatus = $user->ver;
    $verificationCount = User::countVerified();
    $traderId = $user->trader_id;
    $error =
        "<script>" .
            "alert('Сталася помилка! Сторінку буде перезавантажено!');" .
            "window.location.reload();" .
        "</script>";
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
    }
} else {
    echo $error;
}
exit();