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
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$connection->set_charset('utf8');
function save() {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $password = '2014';
    $db = 'joncolab_trade';

    $connection = new mysqli($host, $username, $password, $db);
    if ($connection->connect_error) {
        die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
    }
    $connection->set_charset('utf8');
    $sql = 'SELECT * FROM trade';
}
switch ($_POST["function"]) {
    case 'switch':
        $sql = 'SELECT * FROM lots WHERE id=\'' . $_POST["id"] . '\'';
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
            'customer_number = \'' . $result["customer_number"] . '\', ' .
            'cost_start = \'' . $result["cost_start"] . '\', ' .
            'price_start = \'' . $result["price_start"] . '\', ' .
            'step = \'' . $result["step"] . '\', ' .
            'cost_final = \'' . $result["cost_start"]  . '\', ' .
            'price_final = \'' . $result["price_start"] . '\', ' .
            'current_step = \'0\'';
        $connection->query($sql);
        $message = '<p class="message"><span>Торгується лот №' . $result["id"] . '</span></p>';
        $chat = fopen('auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'addStep':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $nextStep = $currentValues["current_step"] + 1;
        $costFinal = $currentValues["cost_start"] + ($nextStep * $currentValues["step"]);
        $priceFinal = $costFinal * $currentValues["size"];
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        break;
    case 'removeStep':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $nextStep = (($currentValues["current_step"] - 1) < 0) ? (0) : ($currentValues["current_step"] - 1);
        $costFinal = $currentValues["cost_start"] + ($nextStep * $currentValues["step"]);
        $priceFinal = $costFinal * $currentValues["size"];
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        break;
    case 'raiseToPrice':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $costFinal = $_POST["value"];
        $priceFinal = $costFinal * $currentValues["size"];
        $nextStep = floor(($costFinal - $currentValues["cost_start"]) / $currentValues["step"]);
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        $message = '<p class="message"><span>' . $_POST["who"] . ' підвищує до ' . $costFinal . 'грн.</span></p>';
        $chat = fopen('auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'raiseToSteps':
        $sql = 'SELECT current_step, step, cost_start, size FROM trade';
        $currentValues = $connection->query($sql)->fetch_assoc();
        $nextStep = $currentValues["current_step"] + $_POST["value"];
        $costFinal = $currentValues["cost_start"] + ($nextStep * $currentValues["step"]);
        $priceFinal = $costFinal * $currentValues["size"];
        $sql =
            'UPDATE trade SET ' .
            'current_step = \'' . $nextStep . '\', ' .
            'cost_final = \'' . $costFinal . '\', ' .
            'price_final = \'' . $priceFinal . '\'';
        $connection->query($sql);
        $message = '<p class="message"><span>' . $_POST["who"] . ' підвищує до ' . $nextStep . '-го кроку</span></p>';
        $chat = fopen('auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'setWinner':
        $sql = 'UPDATE trade SET customer_number = \'' . $_POST["value"] . '\'';
        $connection->query($sql);
        $sql = 'SELECT * FROM trade';
        $id = $connection->query($sql)->fetch_assoc()["id"];
        $message = '<p class="message"><span>Лот №' . $id . ' придбав ' . $_POST["value"] . '-й</span></p>';
        $chat = fopen('auction-chat.html', 'a');
        fwrite($chat, $message);
        fclose($chat);
        break;
    case 'leave':
        break;
}
$connection->close();