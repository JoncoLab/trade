<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 10:44
 */
error_reporting(E_ALL);
set_time_limit(0);

include "PHPExcelLibrary/PHPExcel.php";
include "PHPExcelLibrary/PHPExcel/Writer/Excel2007.php";
include "PHPExcelLibrary/PHPExcel/IOFactory.php";

$selectedLots = array();
foreach ($_POST as $item => $value) {
    if ($value === 'selected') {
        $selectedLots[] += $item;
    } else {
        print $item . ' => ' . $value . '<br>';
    }
}
?>
<br><br><span>Selected lots:</span><br>
<?php
$length = count($selectedLots);
for ($i = 0; $i < $length; $i++) {
    print ($i + 1 === $length) ? ($selectedLots[$i] . '.') : ($selectedLots[$i] . ', ');
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

$fileType = 'Excel2007';
$fileName = '../../docs/application.xlsx';
$reader = PHPExcel_IOFactory::createReaderForFile($fileName);
$application = $reader->load($fileName);
$application->setActiveSheetIndex(0)
            ->setCellValue('C8', $applicator)
            ->setCellValue('M1', $traderId);

$writer = PHPExcel_IOFactory::createWriter($application);
$writer->save($fileName);
?>



