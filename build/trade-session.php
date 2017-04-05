<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 04.04.2017
 * Time: 20:54
 */
mb_internal_encoding("UTF-8");

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
$connection->set_charset('utf8');
switch ($_POST["function"]) {
    case 'switch':
        $sql = 'SELECT seller_name, id, type, breed, characteristics_diametr, characteristics_sort, gost, characteristics_length, characteristics_storage, size, customers_applied, cost_start, price_start, step FROM lots WHERE id=\'' . $_POST["id"] . '\'';
        $result = $connection->query($sql)->fetch_assoc();
        $sql = 'UPDATE trade SET ' .
            'seller_name = \'' . $result["seller_name"] . '\', ' .
            'id = \'' . $result["id"] . '\', ' .
            'type = \'' . $result["type"] . '\', ' .
            'breed = \'' . $result["breed"] . '\', ' .
            'characteristics_diametr = \'' . $result["characteristics_diametr"] . '\', ' .
            'characteristics_sort = \'' . $result["characteristics_sort"] . '\', ' .
            'gost = \'' . $result["gost"] . '\', ' .
            'characteristics_length = \'' . $result["characteristics_length"] . '\', ' .
            'characteristics_storage = \'' . $result["characteristics_storage"] . '\', ' .
            'size = \'' . $result["size"] . '\', ' .
            'customers_applied = \'' . $result["customers_applied"] . '\', ' .
            'cost_start = \'' . $result["cost_start"] . '\', ' .
            'price_start = \'' . $result["price_start"] . '\', ' .
            'step = \'' . $result["step"] . '\', ' .
            'cost_final = \'' . $result["cost_final"] . '\', ' .
            'price_final = \'' . $result["price_final"] . '\'';
        $connection->query($sql);
        break;
    case 'refresh':
        $sql = 'SELECT * FROM trade';
        $result = $connection->query($sql)->fetch_assoc();
        $array =
            $result["seller_name"] . ',' .
            $result["id"] . ',' .
            $result["type"] . ',' .
            $result["breed"] . ',' .
            $result["characteristics_diametr"] . ',' .
            $result["characteristics_sort"] . ',' .
            $result["gost"] . ',' .
            $result["characteristics_length"] . ',' .
            $result["characteristics_storage"] . ',' .
            $result["size"] . ',' .
            $result["customers_applied"] . ',' .
            $result["cost_start"] . ',' .
            $result["price_start"] . ',' .
            $result["customer_number"] . ',' .
            $result["step"] . ',' .
            $result["cost_final"] . ',' .
            $result["price_final"] . ',' .
            $result["current_step"];
        echo $array;
        break;
    case 'addStep':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $nextStep = $currentValues["current_step"] + 1;
        $costFinal = $currentValues["cost_start"] + ($step * $currentValues["step"]);
        $priceFinal = $costFinal * $currentValues["size"];
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        break;
}
$connection->close();