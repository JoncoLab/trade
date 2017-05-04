<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 27.04.2017
 * Time: 1:12
 */

session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: /index.php');
    die();
}
mb_internal_encoding("UTF-8");

if (isset($_POST["id"]) && isset($_POST["traderId"])) {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $password = '2014';
    $db = 'joncolab_trade';

    $connection = new mysqli($host, $username, $password, $db);
    if ($connection->connect_error) {
        die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
    }
    $connection->set_charset('utf8');
    $sql = 'UPDATE registered SET ver=FALSE, trader_id=NULL, applied_for_lots=NULL, access=FALSE WHERE id=\'' . $_POST["id"] . '\'';
    $connection->query($sql);
    $sql = 'SELECT id, customers_applied FROM lots';
    $result = $connection->query($sql);
    function excludes_user($customer) {
        return ($customer != $_POST["traderId"]);
    }
    while ($lot = $result->fetch_assoc()) {
        $customersApplied = explode(', ', $lot["customers_applied"]);
        $customersApplied = array_filter($customersApplied, "excludes_user");
        $customersApplied = implode(', ', $customersApplied);
        $sql = 'UPDATE lots SET customers_applied=\'' . $customersApplied . '\' WHERE id=\'' . $lot["id"] . '\'';
        $connection->query($sql);
    }
    $connection->close();
    exit();
}