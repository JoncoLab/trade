<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 10:44
 */
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
?>

