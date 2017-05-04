<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 01.05.2017
 * Time: 5:03
 */

session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: /index.php');
    die();
}
mb_internal_encoding("UTF-8");

if (!empty($_FILES)) {
    move_uploaded_file($_FILES["application"]["tmp_name"], '../../../docs/application.xlsx');
}