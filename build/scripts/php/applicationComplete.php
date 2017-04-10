<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 10:44
 */
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$dbPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $dbPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних');
} else {
    $connection->set_charset('utf-8');
    $selectedLots = array();
    foreach ($_POST as $item => $value) {
        if ($value === 'selected') {
            $selectedLots[] += $item;
        }
    }

    $traderId = $_POST["trader-id"];
    $applicator = $_POST["applicator"];
    $previouslyProcessed = $_POST["previously-processed"];
    $representativeName = $_POST["representative-name"];
    $representativeReason = $_POST["representative-reason"];
    $address = $_POST["j-address"];
    $tel = $_POST["tel"];
    $bankDetails = $_POST["bank-details"];
    $edrpou = $_POST["edrpou"];

    foreach ($selectedLots as $selectedLot) {
        $sql = 'SELECT customers_applied FROM lots WHERE id=\'' . $selectedLot . '\'';
        $lot = $connection->query($sql)->fetch_assoc();
        if ($lot["customers_applied"] == '') {
            $sql = 'UPDATE lots SET customers_applied = \'' . $traderId . '\' WHERE id=\'' . $selectedLot . '\'';
        } else {
            $sql = 'UPDATE lots SET customers_applied = \'' . $lot["customers_applied"] . ', ' . $traderId . '\' WHERE id=\'' . $selectedLot . '\'';
        }
        $connection->query($sql);
    }

    $sql = 'UPDATE registered SET applied_for_lots = \'' .implode(', ', $selectedLots) . '\' WHERE trader_id=\'' . $traderId . '\'';
    $connection->query($sql);
    $connection->close();
    header('Location: ../../cabinet.php');
}
?>