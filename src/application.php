<?php
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
if ($_SESSION["id"] == 'ADMIN') {
    header('Location: admin/admin.php');
}
require_once "scripts/php/user.php";
$id = $_SESSION["id"];
$user = User::getUserById($id);
$_SESSION["ver"] = $user->ver;
$_SESSION["access"] = $user->access;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EXChange - Заявка на участь у торгах</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/application.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js" type="text/javascript"></script>
    <script src="scripts/js/application.js" type="text/javascript"></script>
</head>
<body>
<header>
    <?php
    include "assets/menu.php";
    include "assets/logo.html";
    ?>
</header>
<main>
    <section class="app">
        <h2>
            <small id="trader-number"><?php print $user->trader_id;?></small>
            <span>Товарна біржа "Закарпатська універсальна товарно-сировинна біржа"</span><br>
            <small>
                <span>88015, Україна, м. Ужгород, вул. Богомольця, 21;</span>
                <span>телефон: +38 (050) 404 44 98, +38 (067) 480 00 12; електронна пошта: info@ztsb.org.ua;</span>
                <a href="http://www.ztsb.org.ua">веб-сайт</a>
            </small>
        </h2>
        <div class="payment-info">
            <table class="application-numbers">
            <tr>
                <th>Сума 5% = </th>
                <td class="five-percent">0 грн.</td>
            </tr>
            <tr>
                <th>Об'єм заявлених м<sup>3</sup> = </th>
                <td class="application-size">0</td>
            </tr>
            <tr>
                <th>Початкова вартість заявки = </th>
                <td class="application-sum">0 грн.</td>
            </tr>
            </table>
            <span>5% - п/р 26006300574694 в філії ЗОУ АТ "Державний ощадний банк" м. Ужгород, МФО 312356, код ЄДРПОУ 34190565;</span><br>
            <span>400 грн. з ПДВ - р/р 26009015000902 в ПАТ "Комінвестбанк", МФО 312248, код ЄДРПОУ 34190565;</span><br>
            <strong>ОБОВ'ЯЗКОВО! В призначенні платежу вказувати: ЄДРПОУ або РНОКПП(і.п.н.), призначення та Ваш мобільний телефон!</strong>
        </div>
        <h3>
            <span>ЗАЯВА</span><br>
            <small>
                <span>на участь у відкритому аукціоні (додаткових торгах) із продажу необробленої деревини</span><br>
                <strong>по Закарпатському ОУЛМГ на 1 кв. 2017 р.</strong>
            </small>
        </h3>
        <table class="head-info">
            <tbody>
            <tr>
                <td class="field-name">Заявник:</td>
                <td class="field-value auto" colspan="2"><input type="text" required readonly form="application" name="applicator" id="applicator" value="<?php print str_replace('"', '\'\'', $user->full_name);?>" title="<?php print str_replace('"', '\'\'', $user->full_name);?>"></td>
                <td class="field-name" rowspan="2" colspan="2"><label for="previously-processed">Перероблено деревини за минулий квартал (м<sup>3</sup>):</label></td>
                <td class="field-value" rowspan="2"><input required form="application" type="number" min="0" max="500000" maxlength="5" name="previously-processed" id="previously-processed" placeholder="1000"></td>
            </tr>
            <tr>
                <td class="field-name"><label for="representative-name">Представник:</label></td>
                <td class="field-value"><input required form="application" type="text" id="representative-name" name="representative-name" placeholder="ПІБ представника"></td>
                <td class="field-value"><input required form="application" type="text" id="representative-reason" name="representative-reason" placeholder="На підставі чого діє"></td>
            </tr>
            <tr>
                <td class="field-name">Юридична адреса та телефон заявника:</td>
                <td class="field-value auto" colspan="3"><input type="text" required readonly form="application" name="j-address" id="j-address" value="<?php print $user->j_address;?>" title="<?php print $user->j_address;?>"></td>
                <td class="field-value auto" colspan="2"><input type="tel" required readonly form="application" name="tel" id="tel" value="<?php print $user->tel; ?>" title="<?php print $user->tel;?>"></td>
            </tr>
            <tr>
                <td class="field-name"><label for="bank-details">Банківські реквізити заявника:</label></td>
                <td class="field-value" colspan="5"><input required form="application" type="text" id="bank-details" name="bank-details" placeholder="Банківські реквізити заявника"></td>
            </tr>
            <tr>
                <td class="field-name">ЄДРПОУ або РНОКПП(ІПН):</td>
                <td class="field-value auto" colspan="5"><input type="text" required readonly form="application" name="edrpou" id="edrpou" value="<?php print ($user->edrpou == '' ? $user->ind : $user->edrpou);?>" title="<?php print ($user->edrpou == '' ? $user->ind : $user->edrpou);?>"></td>
            </tr>
            </tbody>
        </table>
        <ol class="rules">
            <li>
                <span>Вивчивши інформаційне повідомлення про аукціон бажаю придбати <small>(натисність на лот, аби вибрати)</small>:</span>
                <table class="lots">
                    <thead>
                    <tr>
                        <th class="id" rowspan="2">№</th>
                        <th class="seller-name" rowspan="2">Продавець</th>
                        <th class="type" rowspan="2">Продукція</th>
                        <th class="gost" rowspan="2">ГОСТ</th>
                        <th class="breed" rowspan="2">Порода</th>
                        <th colspan="4">Характеристики лота</th>
                        <th class="size" rowspan="2">Об'єм  лоту (м<sup>3</sup>)</th>
                        <th colspan="2">Вартість у т.ч. ПДВ (грн)</th>
                    </tr>
                    <tr>
                        <th class="characteristics-sort">Ґатунок</th>
                        <th class="characteristics-diametr">Діаметр (см)</th>
                        <th class="characteristics-length">Довжина (м)</th>
                        <th class="characteristics-storage">Склад</th>
                        <th class="cost-start">Початкова за м<sup>3</sup></th>
                        <th class="price-start">Початкова за 1 лот</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $host = 'joncolab.mysql.ukraine.com.ua';
                    $username = 'joncolab_saladin';
                    $dbPassword = '2014';
                    $db = 'joncolab_trade';
                    $connection = new mysqli($host, $username, $dbPassword, $db);

                    if ($connection->connect_error) {
                        die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
                    } else {
                        $connection->set_charset('utf8');
                        $sql = 'SELECT id, seller_name, type, gost, breed, size, characteristics_diametr, characteristics_length, characteristics_sort, characteristics_storage, cost_start, price_start FROM lots ORDER BY id ASC';
                        $lots = $connection->query($sql);
                        $connection->close();
                        if ($lots->num_rows > 0) {
                            while ($lot = $lots->fetch_assoc()) {
                                echo
                                '<tr>' .
                                    '<td class="id">' . $lot["id"] . '</td>' .
                                    '<td class="seller-name">' . $lot["seller_name"] . '</td>' .
                                    '<td class="type">' . $lot["type"] . '</td>' .
                                    '<td class="gost">' . $lot["gost"] . '</td>' .
                                    '<td class="breed">' . $lot["breed"] . '</td>' .
                                    '<td class="characteristics-sort">' . $lot["characteristics_sort"] . '</td>' .
                                    '<td class="characteristics-diametr">' . $lot["characteristics_diametr"] . '</td>' .
                                    '<td class="characteristics-length">' . $lot["characteristics_length"] . '</td>' .
                                    '<td class="characteristics-storage">' . $lot["characteristics_storage"] . '</td>' .
                                    '<td class="size">' . $lot["size"] . '</td>' .
                                    '<td class="cost-start">' . $lot["cost_start"] . '</td>' .
                                    '<td class="price-start">' . $lot["price_start"] . '</td>' .
                                    '<td class="check">' .
                                        '<input form="application" type="checkbox" name="' . $lot["id"] . '" value="">' .
                                    '</td>' .
                                '</tr>';
                            }
                        } else {
                            echo 'Немає жодного доступного лоту!';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </li>
            <li>
                <ol>
                    <li><span>Для участі в аукціоні (торгах) покупці сплачують реєстраційний внесок в сумі 400 грн. (без ПДВ).</span></li>
                    <li><span>У випадку перемоги зобов'язуюсь сплатити після проведення аукціону (торгів) на рахунок Біржі винагороду у розмірі
                        0,6 відсотка (без ПДВ), та всі додаткові витрати за організацію проведення торгів згідо виставленого рахунку.</span></li>
                    <li><span>Заявник повідомлений про його права згідно ст. 8 ЗУ "Про захист персональних даних" та мету обробки його персональних
                        даних ТБ "Закарпатська універсальна товарно-сировинна біржа".</span></li>
                </ol>
            </li>
            <li>
                <div class="rules-accepted">
                    <label for="rules-accepted">З умовами і РЕГЛАМЕНТОМ організації та проведення відкритих аукціонів (торгів) із продажу необробленої деревини згоден</label>
                    <input required form="application" type="checkbox" name="rules-accepted" id="rules-accepted" value="accepted">
                    <label class="checkbox" for="rules-accepted"></label>
                </div>
            </li>
            <li>
                <div class="recording-accepted">
                    <label for="recording-accepted">Даю дозвіл на проведення аудіо та відеозапису проведення аукціону (торгів)</label>
                    <input required form="application" type="checkbox" name="recording-accepted" id="recording-accepted" value="accepted">
                    <label class="checkbox" for="recording-accepted"></label>
                </div>
            </li>
            <li>
                <div class="fine-accepted">
                    <label for="fine-accepted">Згоден з тим, що у випадку анулювання результатів аукціону (торгів) з вини Покупця<br>перерахована ним на
                        розрахунковий рахунок Продавця  сума попереднього внеску (застава) не повертається</label>
                    <input required form="application" type="checkbox" name="fine-accepted" id="fine-accepted" value="accepted">
                    <label class="checkbox" for="fine-accepted"></label>
                </div>
            </li>
            <li>
                <span>Банківські реквізити заявника, за якими слід повертати суму попереднього внеску (застави):</span><br>
                <span class="bank-details">Банківські реквізити заявника</span><br>
                <span>(Гар. внесок 5% суми = <strong class="five-percent">0 грн.</strong>)</span>
            </li>
            <li>
                <div class="laws-accepted">
                    <label for="laws-accepted">З нормами ст. 1-2, 8-10, 15, 17 Закону України "Про товарну біржу" та ст. 278-282 Господарського кодексу
                        України<br>ознайомлений та зобов'язуюсь їх дотримуватись</label>
                    <input required form="application" type="checkbox" name="laws-accepted" id="laws-accepted" value="accepted">
                    <label class="checkbox" for="laws-accepted"></label>
                </div>
                <span></span>
            </li>
        </ol>
        <p class="remark"><strong>Примітка: Біржа відмовляє Покупцю в участі в аукціонних торгах або в реєстрації учасників, якщо у встановлену
            біржою форму заявки самовільно були внесені зміни, виправлення або доповнення.</strong></p>
        <div class="agreement">
            <span class="date">Дата: <strong><?php print date("d.m.Y")?></strong></span>
            <div class="signature">
                <label for="agreed">Усі поля заповнені мною вірно</label>
                <input required form="application" type="checkbox" name="agreed" id="agreed" value="agreed">
                <label for="agreed" class="checkbox"></label>
                <strong><?php print $user->docs_name;?></strong>
            </div>
        </div>
        <form method="post" action="scripts/php/applicationComplete.php" id="application" name="application">
            <input type="reset" id="reset" name="reset">
            <label for="reset">Очистити всі поля</label>
            <input type="submit" id="submit" name="submit">
            <label for="submit">Надіслати заявку до опрацювання</label>
            <input required type="hidden" name="trader-id" value="<?php print $user->trader_id;?>">
            <input required type="hidden" name="five-percent" id="five-percent">
            <input required type="hidden" name="application-size" id="application-size">
            <input required type="hidden" name="application-sum" id="application-sum">
        </form>
    </section>
</main>
<?php
include "assets/footer.html";
?>
</body>
</html>