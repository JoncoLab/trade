<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 10:44
 */
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

require_once 'PHPExcel.php';
require_once 'PHPExcel/Writer/Excel2007.php';
require_once 'PHPExcel/IOFactory.php';

function get24hTime() {
    $time = null;
    if (date("a") === 'pm') {
        switch (date("h")) {
            case '01':
                $time = '13:' . date("i");
                break;
            case '02':
                $time = '14:' . date("i");
                break;
            case '03':
                $time = '15:' . date("i");
                break;
            case '04':
                $time = '16:' . date("i");
                break;
            case '05':
                $time = '17:' . date("i");
                break;
            case '06':
                $time = '18:' . date("i");
                break;
            case '07':
                $time = '19:' . date("i");
                break;
            case '08':
                $time = '20:' . date("i");
                break;
            case '09':
                $time = '21:' . date("i");
                break;
            case '10':
                $time = '22:' . date("i");
                break;
            case '11':
                $time = '23:' . date("i");
                break;
            default:
                $time = date("h:i");
        }
    } else {
        $time = date("h:i");
    }
    return $time;
}

if (isset($_POST["submit"]) && $_SESSION["ver"] == 1) {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $dbPassword = '2014';
    $db = 'joncolab_trade';
    $connection = new mysqli($host, $username, $dbPassword, $db);

    if ($connection->connect_error) {
        die('Не вдається встановити підключення до бази даних');
    }
    $connection->set_charset('utf-8');
    $sql = 'SELECT * FROM settings';
    $settings = $connection->query($sql)->fetch_assoc();
    $selectedLots = array();
    foreach ($_POST as $item => $value) {
        if ($value === 'selected') {
            $selectedLots[] += $item;
        }
    }

    $traderId = $_POST["trader-id"];
    $fivePercent = $_POST["five-percent"];
    $applicationSize = $_POST["application-size"];
    $applicationSum = $_POST["application-sum"];
    $applicator = str_replace('\'\'', '"', $_POST["applicator"]);
    $previouslyProcessed = $_POST["previously-processed"];
    $representativeName = $_POST["representative-name"];
    $representativeReason = $_POST["representative-reason"];
    $address = $_POST["j-address"];
    $tel = $_POST["tel"];
    $bankDetails = $_POST["bank-details"];
    $edrpou = $_POST["edrpou"];
    $sql = 'SELECT docs_name, email FROM registered WHERE trader_id=\'' . $traderId . '\'';
    $result = $connection->query($sql)->fetch_assoc();
    $docsName = $result["docs_name"];
    $email = $result["email"];

    foreach ($selectedLots as $selectedLot) {
        $sql = 'SELECT customers_applied FROM lots WHERE id=\'' . $selectedLot . '\'';
        $lot = $connection->query($sql)->fetch_assoc();
        $customersApplied = explode(', ', $lot["customers_applied"]);
        if (!in_array($traderId, $customersApplied)) {
            if ($lot["customers_applied"] == '') {
                $sql = 'UPDATE lots SET customers_applied = \'' . $traderId . '\' WHERE id=\'' . $selectedLot . '\'';
            } else {
                $sql = 'UPDATE lots SET customers_applied = \'' . $lot["customers_applied"] . ', ' . $traderId . '\' WHERE id=\'' . $selectedLot . '\'';
            }
        }
        $connection->query($sql);
    }


    $appliedForLots = implode(', ', $selectedLots);
    $sql = 'UPDATE registered SET applied_for_lots = \'' . $appliedForLots . '\' WHERE trader_id=\'' . $traderId . '\'';
    $connection->query($sql);

    $excel = PHPExcel_IOFactory::load(str_replace('scripts/php', '', __DIR__) . 'docs/application.xlsx');
    $excel->setActiveSheetIndex(1);
    $sheet = $excel->getActiveSheet();
    $sheet->setCellValue('C3', $traderId);
    $sheet->setCellValue('C4', $applicator);
    $sheet->setCellValue('C5', $edrpou);
    $sheet->setCellValue('C6', $address);
    $sheet->setCellValue('C7', $bankDetails);
    $sheet->setCellValue('C8', substr($tel, 1));
    $sheet->setCellValue('C9', $previouslyProcessed);
    $sheet->setCellValue('C10', $representativeName);
    $sheet->setCellValue('C11', $representativeReason);
    $sheet->setCellValue('C13', $email);
    $sheet->setCellValue('C15', $docsName);
    $sheet->setCellValue('C16', date("d.m.Y") . "р.");
    $excel->setActiveSheetIndex(0);
    $sheet = $excel->getActiveSheet();
    $sheet->setCellValue('M4', $fivePercent);
    $sheet->setCellValue('M5', $applicationSize);
    $sheet->setCellValue('M6', $applicationSum);
    $rows = $sheet->getRowIterator();
    $sql = 'SELECT id FROM lots';
    $result = $connection->query($sql);
    $allLots = array();
    while ($lot = $result->fetch_assoc()) {
        $allLots[] += $lot["id"];
    }
    foreach ($rows as $row) {
        $lotId = $sheet->getCell('A' . $row->getRowIndex())->getValue();
        if (!in_array($lotId, $selectedLots) && in_array($lotId, $allLots)) {
            $sheet->removeRow($row->getRowIndex());
        }
    }
    $writer = new PHPExcel_Writer_Excel2007($excel);
    mkdir(str_replace('scripts/php', '', __DIR__) . 'docs/' . $traderId);
    $writer->save(str_replace('scripts/php', '', __DIR__) . 'docs/' . $traderId . '/' . date("Y-m-d") . '-' . get24hTime() . '.xlsx');
    $connection->close();

    $filename = str_replace('scripts/php', '', __DIR__) . 'docs/' . $traderId . '/' . date("Y-m-d") . '-' . get24hTime() . '.xlsx';
    $p = "\r\n";
    $to = $email;
    $subject = 'Заявка EXChange';
    $boundary = md5(date('r', time()));
    $headers = 'MIME-Version: 1.0' . $p;
    $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"; charset="utf-8"' . $p;
    $headers .= 'From: EXChange <no-reply@exchange.roik.pro>' . $p;
    $headers .= 'BCC: ' . $settings["to"];
    $message = 'Доброго дня!' . $p;
    $message .= 'Вашу заявку за торговим номером ' . $traderId . ' сформовано і отримано ТБ "ЗУСТБ"' . $p;
    $message .= 'До листа додано копію.';
    $multipartMessage = '--' . $boundary . $p;
    $multipartMessage .= 'Content-Type: text/plain; charset="utf-8"' . $p;
    $multipartMessage .= 'Content-Transfer-Encoding: bit7' . $p . $p;
    $multipartMessage .= $message . $p . $p;
    $multipartMessage .= '--' . $boundary . $p;
    $multipartMessage .= 'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; name=' . basename($filename) . $p;
    $multipartMessage .= 'Content-Transfer-Encoding: base64' . $p;
    $multipartMessage .= 'Content-Disposition: attachment; filename="' . $traderId . '-Заявка-' . str_replace(' ', '-', $docsName) . '.xlsx"' . $p . $p;
    $multipartMessage .= chunk_split(base64_encode(file_get_contents($filename))). $p;
    $multipartMessage .= '--' . $boundary . '--' . $p;
    mail($to, $subject, $multipartMessage, $headers);

    header('Location: ../../cabinet.php');
} else {
    header('Location: logout.php');
}