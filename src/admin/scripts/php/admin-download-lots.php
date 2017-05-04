<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 01.05.2017
 * Time: 16:39
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
require_once "../../../scripts/php/PHPExcel/Writer/Excel2007.php";

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$password = '2014';
$db = 'joncolab_trade';

$connection = new mysqli($host, $username, $password, $db);
if ($connection->connect_error) {
    die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
}
$connection->set_charset('utf8');
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
header('Expires: Mon, 1 Apr 1974 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D,d M YH:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=lots-' . date("d-m-Y-h:i") . '.xlsx');
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save('php://output');

$connection->close();
exit();