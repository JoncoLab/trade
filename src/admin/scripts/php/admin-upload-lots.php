<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 23.04.2017
 * Time: 15:11
 */

session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: /index.php');
    die();
}
mb_internal_encoding("UTF-8");

require_once "../../../scripts/php/PHPExcel.php";
require_once "../../../scripts/php/PHPExcel/IOFactory.php";

if (!empty($_FILES)) {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $password = '2014';
    $db = 'joncolab_trade';

    $connection = new mysqli($host, $username, $password, $db);
    if ($connection->connect_error) {
        die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
    }
    $connection->set_charset('utf8');
    $excel = PHPExcel_IOFactory::load($_FILES["lots"]["tmp_name"]);
    $excel->setActiveSheetIndex(0);
    $sheet = $excel->getActiveSheet();
    $rows = $sheet->getRowIterator();
    $start = 0;
    foreach ($rows as $row) {
        $index = $row->getRowIndex();
        $firstCellValue = $sheet->getCell('A' . $index)->getValue();
        if ($firstCellValue == '№ лота') {
            $start = $index + 3;
            break;
        }
    }
    $finish = $sheet->getHighestRow();
    $lots = $sheet->getRowIterator($start, $finish);
    foreach ($lots as $lot) {
        $index = $lot->getRowIndex();
        $id = $sheet->getCell('A' . $index)->getValue();
        $sellerName = $sheet->getCell('C' . $index)->getValue();
        $type = $sheet->getCell('D' . $index)->getValue();
        $gost = $sheet->getCell('E' . $index)->getValue();
        $breed = $sheet->getCell('F' . $index)->getValue();
        $characteristicsSort = $sheet->getCell('G' . $index)->getValue();
        $characteristicsDiametr = $sheet->getCell('H' . $index)->getValue();
        $characteristicsLength = $sheet->getCell('I' . $index)->getValue();
        $characteristicsStorage = $sheet->getCell('J' . $index)->getValue();
        $size = $sheet->getCell('K' . $index)->getValue();
        $costStart = $sheet->getCell('L' . $index)->getValue();
        $priceStart = $costStart * $size;
        $step = preg_match('/Дрова/', $type) ? 10 : (preg_match('/дуб/', $breed) ? 40 : 20);
        $costFinal = $costStart;
        $customerNumber = null;
        $priceFinal = $priceStart;
        $sellerId = null;
        $customersApplied = null;
        $guarantee = $priceStart * 0.05;
        $profit = $priceStart * 0.001;

        $sql = "INSERT INTO lots VALUES ('" . $id . "', '" .
            $sellerName . "', '" .
            $type . "', '" .
            $gost . "', '" .
            $breed . "', '" .
            $characteristicsSort . "', '" .
            $characteristicsDiametr . "', '" .
            $characteristicsLength . "', '" .
            $characteristicsStorage . "', '" .
            $size . "', '" .
            $costStart . "', '" .
            $priceStart . "', '" .
            $step . "', '" .
            $costFinal . "', '" .
            $customerNumber . "', '" .
            $priceFinal . "', '" .
            $sellerId . "', '" .
            $customersApplied . "', '" .
            $guarantee . "', '" .
            $profit . "')";
        $connection->query($sql);
        if ($connection->error) {
            echo $connection->error;
        }
    }

    $connection->close();

}
exit();
