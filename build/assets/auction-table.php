<?php
mb_internal_encoding("UTF-8");
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
} else {
    $connection->set_charset('utf8');
    $sql = 'SELECT * FROM trade';
    $lot = $connection->query($sql)->fetch_assoc();
}
?>
<tbody>
<tr>
    <td class="attribute" colspan="2">Продавець:</td>
    <td class="value seller-name" colspan="7"><?php print $lot["seller_name"];?></td>
</tr>
<tr>
    <td class="attribute" rowspan="2">Лот №</td>
    <td class="value id" rowspan="2"><?php print $lot["id"];?></td>
    <td class="attr-value type" colspan="2"><?php print $lot["type"];?></td>
    <td class="attribute">Діаметр, см:</td>
    <td class="value characteristics-diametr"><?php print $lot["characteristics_diametr"];?></td>
    <td class="attribute">Сорт:</td>
    <td class="value characteristics-sort"><?php print $lot["characteristics_sort"];?></td>
    <td class="attribute">ГОСТ</td>
</tr>
<tr>
    <td class="attr-value breed" colspan="2"><?php print $lot["breed"];?></td>
    <td class="attribute">Довжина, м:</td>
    <td class="value characteristics-length"><?php print $lot["characteristics_length"];?></td>
    <td class="attribute">Склад:</td>
    <td class="value characteristics-storage"><?php print $lot["characteristics_storage"];?></td>
    <td class="value gost"><?php print $lot["gost"];?></td>
</tr>
<tr>
    <td class="attribute">Об'єм лоту, м<sup>3</sup></td>
    <td class="value size" colspan="3"><?php print $lot["size"];?></td>
    <td class="attribute">Учасники:</td>
    <td class="value customers-applied" colspan="4">
        <?php
        $customers = explode(', ', $lot["customers_applied"]);
        $length = count($customers);
        for ($i = 0; $i < $length - 1; $i++) {
            echo '<span class="customer">' . $customers[$i] . '</span>, ';
        }
        echo '<span class="customer">' . $customers[$length - 1] . '</span>;';
        ?>
    </td>
</tr>
<tr>
    <td class="attribute" colspan="2">Початкова ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>:</td>
    <td class="value cost-start" colspan="2"><?php print $lot["cost_start"];?></td>
    <td class="attribute">Покупець:</td>
    <td class="value customer-number" colspan="2"><?php print $lot["customer_number"];?></td>
    <td class="attribute">Розмір кроку (грн.):</td>
    <td class="value step"><?php print $lot["step"];?></td>
</tr>
<tr>
    <td class="attribute" colspan="2">Остаточна ціна, <sup>грн</sup>/<sub>м<sup>3</sup></sub>:</td>
    <td class="value cost-final" colspan="2"><?php print $lot["cost_final"];?></td>
    <td class="attribute">Остаточна вартість, <sup>грн.</sup>/<sub>лот</sub>:</td>
    <td class="value price-final" colspan="2"><?php print $lot["price_final"];?></td>
    <td class="attribute">Крок:</td>
    <td class="value current-step"><?php print $lot["current_step"];?></td>
</tr>
</tbody>
<?php
$connection->close();
?>