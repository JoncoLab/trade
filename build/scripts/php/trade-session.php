<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 04.04.2017
 * Time: 20:54
 */
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

if (($_SESSION["ver"] == 1 && $_SESSION["access"] == 1) || $_SESSION["id"] == 'ADMIN') {
    mb_internal_encoding("UTF-8");
    require_once "PHPExcel.php";
    require_once "PHPExcel/IOFactory.php";
    require_once "PHPExcel/Writer/Excel2007.php";

    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $password = '2014';
    $db = 'joncolab_trade';
    $connection = new mysqli($host, $username, $password, $db);
    if ($connection->connect_error) {
        die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
    }
    $connection->set_charset('utf8');
    function get24hTime() {
        $time = null;
        if (date("a") === 'pm') {
            switch (date("h")) {
                case '01':
                    $time = '13:' . date("i:s");
                    break;
                case '02':
                    $time = '14:' . date("i:s");
                    break;
                case '03':
                    $time = '15:' . date("i:s");
                    break;
                case '04':
                    $time = '16:' . date("i:s");
                    break;
                case '05':
                    $time = '17:' . date("i:s");
                    break;
                case '06':
                    $time = '18:' . date("i:s");
                    break;
                case '07':
                    $time = '19:' . date("i:s");
                    break;
                case '08':
                    $time = '20:' . date("i:s");
                    break;
                case '09':
                    $time = '21:' . date("i:s");
                    break;
                case '10':
                    $time = '22:' . date("i:s");
                    break;
                case '11':
                    $time = '23:' . date("i:s");
                    break;
                default:
                    $time = date("h:i:s");
            }
        } else {
            $time = date("h:i:s");
        }
        return $time;
    }
    $sql = 'SELECT * FROM settings';
    $settings = $connection->query($sql)->fetch_assoc();
    $timer = $settings["timer"];

    switch ($_POST["function"]) {
        case 'switch':
            $sql = 'SELECT id, customer_number, cost_final, price_final FROM trade WHERE id IS NOT NULL';
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                $lot = $result->fetch_assoc();
                $sql = 'UPDATE lots SET customer_number=\'' . $lot["customer_number"] .
                    '\', cost_final=\'' . $lot["cost_final"] .
                    '\', price_final=\'' . $lot["price_final"] .
                    '\', profit=\'' . ($lot["price_final"] * 0.001) . '\' ' .
                    'WHERE id=\'' . $lot["id"] . '\'';
                $connection->query($sql);
            }
            $sql = 'SELECT * FROM lots WHERE id=\'' . $_POST["id"] . '\'';
            $result = $connection->query($sql)->fetch_assoc();
            $sql = 'UPDATE trade SET ' .
                'seller_name=\'' . $result["seller_name"] . '\', ' .
                'id=\'' . $result["id"] . '\', ' .
                'type=\'' . $result["type"] . '\', ' .
                'breed=\'' . $result["breed"] . '\', ' .
                'characteristics_diametr=\'' . $result["characteristics_diametr"] . '\', ' .
                'characteristics_sort=\'' . $result["characteristics_sort"] . '\', ' .
                'gost=\'' . $result["gost"] . '\', ' .
                'characteristics_length=\'' . $result["characteristics_length"] . '\', ' .
                'characteristics_storage=\'' . $result["characteristics_storage"] . '\', ' .
                'size=\'' . $result["size"] . '\', ' .
                'customers_applied=\'' . $result["customers_applied"] . '\', ' .
                'customer_number=\'' . $result["customer_number"] . '\', ' .
                'cost_start=\'' . $result["cost_start"] . '\', ' .
                'price_start=\'' . $result["price_start"] . '\', ' .
                'step=\'' . $result["step"] . '\', ' .
                'cost_final=\'' . $result["cost_final"]  . '\', ' .
                'price_final=\'' . $result["price_final"] . '\', ' .
                'current_step=\'' . (($result["cost_final"] - $result["cost_start"]) / $result["step"]) . '\'';
            $connection->query($sql);
            $sql = 'UPDATE online SET online=FALSE';
            $connection->query($sql);
            $message =
                '<p class="message admin">' .
                '<span class="time">' . get24hTime() . '</span>' .
                '<span>Торгується лот №' . $result["id"] . '</span>' .
                '</p>';
            $chat = fopen('../../assets/auction-chat.html', 'a');
            fwrite($chat, $message);
            fclose($chat);
            $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
            $connection->query($sql);
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
            $message =
                '<p class="message admin">' .
                '<span class="time">' . get24hTime() . '</span>' .
                '<span>' . $_POST["who"] . ' підвищує до ' . $nextStep . '-го кроку (' . $costFinal . 'грн.)</span>' .
                '</p>';
            $chat = fopen('../../assets/auction-chat.html', 'a');
            fwrite($chat, $message);
            fclose($chat);
            $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
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
            $message =
                '<p class="message admin">' .
                '<span class="time">' . get24hTime() . '</span>' .
                '<span>' . $_POST["who"] . ' знижує до ' . $nextStep . '-го кроку (' . $costFinal . 'грн.)</span>' .
                '</p>';
            $chat = fopen('../../assets/auction-chat.html', 'a');
            fwrite($chat, $message);
            fclose($chat);
            $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
            $connection->query($sql);
            break;
        case 'raiseToPrice':
            $sql = 'SELECT customer_number FROM trade';
            $customerNumber = $connection->query($sql)->fetch_assoc()["customer_number"];
            $sql = 'SELECT online FROM online WHERE trader_id=\'' . $_POST["who"] . '\' AND online=TRUE';
            if (($connection->query($sql)->num_rows > 0 && $customerNumber == 0) || $_POST["who"] == 'Ліцетатор') {
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
                $message =
                    '<p class="message' . ($_POST["who"] == 'Ліцетатор' ? ' admin' : '') . '">' .
                    '<span class="time">' . get24hTime() . '</span>' .
                    '<span>' . $_POST["who"] . ' підвищує до ' . $costFinal . 'грн.</span>' .
                    '</p>';
                $chat = fopen('../../assets/auction-chat.html', 'a');
                fwrite($chat, $message);
                fclose($chat);
                $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
                $connection->query($sql);
            }

            break;
        case 'raiseToSteps':
            $sql = 'SELECT customer_number FROM trade';
            $customerNumber = $connection->query($sql)->fetch_assoc()["customer_number"];
            $sql = 'SELECT online FROM online WHERE trader_id=\'' . $_POST["who"] . '\' AND online=TRUE';
            if (($connection->query($sql)->num_rows > 0 && $customerNumber == 0) || $_POST["who"] == 'Ліцетатор') {
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
                $message =
                    '<p class="message">' .
                    '<span class="time">' . get24hTime() . '</span>' .
                    '<span>' . $_POST["who"] . ' підвищує до ' . $nextStep . '-го кроку (' . $costFinal . 'грн.)</span>' .
                    '</p>';
                $chat = fopen('../../assets/auction-chat.html', 'a');
                fwrite($chat, $message);
                fclose($chat);
                $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
                $connection->query($sql);
            }
            break;
        case 'setWinner':
            $sql = 'SELECT customers_applied FROM trade';
            $customersApplied = explode(', ', $connection->query($sql)->fetch_assoc()["customers_applied"]);
            if (in_array($_POST["value"], $customersApplied)) {
                $sql = 'UPDATE trade SET customer_number = \'' . $_POST["value"] . '\'';
                $connection->query($sql);
                $sql = 'SELECT * FROM trade';
                $id = $connection->query($sql)->fetch_assoc()["id"];
                $finalPrice = $connection->query($sql)->fetch_assoc()["price_final"];
                $message =
                    '<p class="message admin">' .
                    '<span class="time">' . get24hTime() . '</span>' .
                    '<span>Лот №' . $id . ' придбав ' . $_POST["value"] . '-й за ' . $finalPrice . ' грн.</span>' .
                    '</p>';
                $chat = fopen('../../assets/auction-chat.html', 'a');
                fwrite($chat, $message);
                fclose($chat);
                $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
                $connection->query($sql);
            }
            break;
        case 'leave':
            $sql = 'UPDATE online SET online=FALSE WHERE trader_id=\'' . $_POST["who"] . '\'';
            $connection->query($sql);
            break;
        case 'takePart':
            $sql = 'SELECT customers_applied FROM trade';
            $customersApplied = explode(', ', $connection->query($sql)->fetch_assoc()["customers_applied"]);
            if (in_array($_POST["who"], $customersApplied)) {
                $sql = 'UPDATE online SET online=TRUE WHERE trader_id=\'' . $_POST["who"] . '\'';
                $connection->query($sql);
            }
            break;
        case 'end':
            $sql = 'SELECT id, customer_number, cost_final, price_final FROM trade WHERE id IS NOT NULL';
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                $lot = $result->fetch_assoc();
                $sql = 'UPDATE lots SET customer_number=\'' . $lot["customer_number"] .
                    '\', cost_final=\'' . $lot["cost_final"] .
                    '\', price_final=\'' . $lot["price_final"] .
                    '\', profit=\'' . ($lot["price_final"] * 0.001) . '\' ' .
                    'WHERE id=\'' . $lot["id"] . '\'';
                $connection->query($sql);
            }
            $sql = 'UPDATE trade SET session_active = FALSE, seller_name = NULL, id = NULL, type = NULL, breed = NULL, characteristics_diametr = NULL, characteristics_storage = NULL, characteristics_length = NULL, characteristics_sort = NULL, gost = NULL, size = NULL, customers_applied = NULL, cost_start = NULL, customer_number = NULL, step = NULL, cost_final = NULL, price_final = NULL, current_step = NULL, seconds_left=0';
            $connection->query($sql);
            $sql = 'TRUNCATE TABLE online';
            $connection->query($sql);
            copy('../../assets/auction-chat.html', '../../docs/archive/chat-' . date("d-m-Y-h:i") . '.html');
            $file = '../../docs/archive/chat-' . date("d-m-Y-h:i") . '.html';
            $chat = fopen('../../assets/auction-chat.html', 'w');
            fwrite($chat, '');
            fclose($chat);

            $p = "\r\n";
            $to = $settings["to"];
            $subject = 'Результати торгів від ' . date("d-m-Y h:i");
            $boundary = md5(date('r', time()));
            $headers = 'From: EXChange <no-reply@exchange.roik.pro>' . $p;
            $headers .= 'MIME-Version: 1.0' . $p;
            $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"; charset="utf-8"' . $p;
            $message = 'Таблиця лотів та копія чату прикріплені до листа.';
            $multipartMessage = '--' . $boundary . $p;
            $multipartMessage .= 'Content-Type: text/plain; charset="utf-8"' . $p;
            $multipartMessage .= 'Content-Transfer-Encoding: bit7' . $p . $p;
            $multipartMessage .= $message . $p . $p;
            $multipartMessage .= '--' . $boundary . $p;
            $multipartMessage .= 'Content-Type: text/html; name=' . $file . $p;
            $multipartMessage .= 'Content-Transfer-Encoding: base64' . $p;
            $multipartMessage .= 'Content-Disposition: attachment; filename="chat.html"' . $p . $p;
            $multipartMessage .= file_get_contents($file) . $p;
            $multipartMessage .= '--' . $boundary . $p;

            $excel = new PHPExcel();
            $excel->setActiveSheetIndex(0);
            $sheet = $excel->getActiveSheet();
            $sheet->setTitle('Лоти');
            $sheet->setCellValue('A1', 'Номер лоту');
            $sheet->setCellValue('B1', 'Назва продавця');
            $sheet->setCellValue('C1', 'Назва асортименту');
            $sheet->setCellValue('D1', 'ГОСТ');
            $sheet->setCellValue('E1', 'Порода');
            $sheet->setCellValue('F1', 'Гатунок');
            $sheet->setCellValue('G1', 'Діаметр');
            $sheet->setCellValue('H1', 'Довжина');
            $sheet->setCellValue('I1', 'Склад');
            $sheet->setCellValue('J1', 'Об\'єм');
            $sheet->setCellValue('K1', 'Ціна за куб');
            $sheet->setCellValue('L1', 'Вартість лоту');
            $sheet->setCellValue('M1', 'Крок ціни');
            $sheet->setCellValue('N1', 'Остаточна ціна за куб');
            $sheet->setCellValue('O1', 'Номер покупця');
            $sheet->setCellValue('P1', 'Остаточна вартість');
            $sheet->setCellValue('Q1', 'Номер продавця');
            $sheet->setCellValue('R1', 'Заявлені учасники');
            $sheet->setCellValue('S1', 'Гарантійний внесок');
            $sheet->setCellValue('T1', 'Біржова винагорода');
            $sql = 'SELECT * FROM lots';
            $result = $connection->query($sql);
            $i = 2;
            while ($lot = $result->fetch_assoc()) {
                $sheet->setCellValue('A' . $i, $lot["id"]);
                $sheet->setCellValue('B' . $i, $lot["seller_name"]);
                $sheet->setCellValue('C' . $i, $lot["type"]);
                $sheet->setCellValue('D' . $i, $lot["gost"]);
                $sheet->setCellValue('E' . $i, $lot["breed"]);
                $sheet->setCellValue('F' . $i, $lot["characteristics_sort"]);
                $sheet->setCellValue('G' . $i, $lot["characteristics_diametr"]);
                $sheet->setCellValue('H' . $i, $lot["characteristics_length"]);
                $sheet->setCellValue('I' . $i, $lot["characteristics_storage"]);
                $sheet->setCellValue('J' . $i, $lot["size"]);
                $sheet->setCellValue('K' . $i, $lot["cost_start"]);
                $sheet->setCellValue('L' . $i, $lot["price_start"]);
                $sheet->setCellValue('M' . $i, $lot["step"]);
                $sheet->setCellValue('N' . $i, $lot["cost_final"]);
                $sheet->setCellValue('O' . $i, $lot["customer_number"]);
                $sheet->setCellValue('P' . $i, $lot["price_final"]);
                $sheet->setCellValue('Q' . $i, $lot["seller_id"]);
                $sheet->setCellValue('R' . $i, $lot["customers_applied"]);
                $sheet->setCellValue('S' . $i, $lot["guarantee"]);
                $sheet->setCellValue('T' . $i, $lot["profit"]);
                $i++;
            }
            $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            $writer->save('../../docs/archive/lots-' . date("d-m-Y-h:i") . '.xlsx');
            $file = '../../docs/archive/lots-' . date("d-m-Y-h:i") . '.xlsx';

            $multipartMessage .= 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; name=' . $file . $p;
            $multipartMessage .= 'Content-Transfer-Encoding: base64' . $p;
            $multipartMessage .= 'Content-Disposition: attachment; filename="lots.xlsx"' . $p . $p;
            $multipartMessage .= chunk_split(base64_encode(file_get_contents($file))) . $p;
            $multipartMessage .= '--' . $boundary . '--' . $p;
            mail($to, $subject, $multipartMessage, $headers);
            $connection->close();
            break;
        case 'write':
            $message =
                '<p class="message admin">' .
                '<span class="time">' . get24hTime() . '</span>' .
                '<span>' . $_POST["value"] . '</span>' .
                '</p>';
            $chat = fopen('../../assets/auction-chat.html', 'a');
            fwrite($chat, $message);
            fclose($chat);
            break;
        case 'timer':
            $sql = 'SELECT seconds_left, session_active, customer_number, id FROM trade';
            $result = $connection->query($sql)->fetch_assoc();
            $customerNumber = $result["customer_number"];
            $sessionActive = $result["session_active"];
            $id = $result["id"];
            $current = $result["seconds_left"];
            if ($customerNumber == 0 && $sessionActive == 1 && $id != 0) {
                if ($current == 0) {
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
                    $message =
                        '<p class="message admin">' .
                        '<span class="time">' . get24hTime() . '</span>' .
                        '<span>' . $_POST["who"] . ' підвищує до ' . $nextStep . '-го кроку (' . $costFinal . 'грн.)</span>' .
                        '</p>';
                    $chat = fopen('../../assets/auction-chat.html', 'a');
                    fwrite($chat, $message);
                    fclose($chat);
                    $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
                    $connection->query($sql);
                } else {
                    $new = $current - 1;
                    $sql = 'UPDATE trade SET seconds_left=\'' . $new . '\'';
                    $connection->query($sql);
                }
            } elseif ($current !== 15) {
                $sql = 'UPDATE trade SET seconds_left=\'' . $timer . '\'';
                $connection->query($sql);
            }
            break;
    }
    $connection->close();
} else {
    header('Location: logout.php');
}