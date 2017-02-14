<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: start.html");
    session_unset();
    session_destroy();
    exit();
}
include 'scripts/php/user.php';
$fullName = $_SESSION["full_name"];
$jAddress = $_SESSION["j_address"];
$tel = $_SESSION["tel"];
$edrpou = $_SESSION["edrpou"];
$docsName = $_SESSION["docs_name"];
$traderId = $_SESSION["trader_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EXChange - Заявка на участь у торгах</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/application.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/script.js" type="text/javascript"></script>
    <script src="scripts/js/application.js" type="text/javascript"></script>
</head>
<body>
<header>
    <menu class="main-menu"> <img class="menu-icon" src="SVG/menu.svg"> <span>Меню</span>
        <ul class="menu">
            <li><img class="ico" src="SVG/user-light.svg"><a href="cabinet-page.php">Мій кабінет</a></li>
            <li><img class="ico" src="SVG/hammer2-light.svg"><a href="auction.php">Аукціон</a></li>
            <li><img class="ico" src="SVG/office-light.svg"><a href="../about.php">Про компанію</a></li>
            <li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.php">Новини проекту</a></li>
            <li><img class="ico" src="SVG/book-light.svg"><a href="../rules.php">Правила та умови</a></li>
            <li><img class="ico" src="SVG/doc-light.svg"><a href="application.php">Подати заявку на участь в торгах</a></li>
            <li><img class="ico" src="SVG/archive-light.svg"><a href="archive.php">Архів заявок</a></li>
            <li><img class="ico" src="SVG/exit-light.svg"><a href="../scripts/php/logout.php">Вихід</a></li>
        </ul>
        <script>
            $(document).ready(function () {
                $('.main-menu .menu-icon, .main-menu > span').hover(function () {
                    $('.main-menu .menu-icon').css('transform', 'scale(1.15)');
                }, function () {
                    $('.main-menu .menu-icon').css('transform', 'scale(1)');
                });
                $('.main-menu .menu-icon, .main-menu > span').click(function () {
                    $('.main-menu ul').fadeToggle(300);
                });
            });
        </script>
    </menu>
    <div class="logo">
        <img src="images/logo.png" alt="Логотип">
        <h1>EXChange</h1>
    </div>
</header>
<main>
    <section class="app">
        <h2>
            <small id="trader-number"><?php print $traderId;?></small>
            <span>Товарна біржа "Закарпатська універсальна товарно-сировинна біржа"</span><br>
            <small>
                <span>88015, Україна, м. Ужгород, вул. Богомольця, 21;</span>
                <span>телефон: +38 (050) 404 44 98, +38 (067) 480 00 12; електронна пошта: info@ztsb.org.ua;</span>
                <a href="http://www.ztsb.org.ua">веб-сайт</a>
            </small>
        </h2>
        <p class="payment-info">
            <strong class="five-percent">Сума 5% =<br><span class="value">0 грн.</span></strong>
            <span>5% - п/р 26006300574694 в філії ЗОУ АТ "Державний ощадний банк" м. Ужгород, МФО 312356, код ЄДРПОУ 34190565;</span><br>
            <span>375грн. з ПДВ - р/р 26009015000902 в ПАТ "Комінвестбанк", МФО 312248, код ЄДРПОУ 34190565;</span><br>
            <strong>ОБОВ'ЯЗКОВО! в призначенні платежу вказувати: ЄДРПОУ або РНОКПП(і.п.н.), призначення та Ваш мобільний телефон!</strong>
        </p>
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
                <?php echo '<td class="field-value auto" colspan="2"><input type="text" readonly form="application" name="applicator" id="applicator" value="' . $fullName . '" title="' . $fullName . '"></td>'; ?>
                <td class="field-name" rowspan="2" colspan="2"><label for="previously-processed">Перероблено деревини за минулий квартал (м<sup>3</sup>):</label></td>
                <td class="field-value" rowspan="2"><input required form="application" type="number" min="0" max="50000" step="5" maxlength="5" name="previously-processed" id="previously-processed" placeholder="1000"></td>
            </tr>
            <tr>
                <td class="field-name"><label for="representative-name">Представник:</label></td>
                <td class="field-value"><input required form="application" type="text" id="representative-name" name="representative-name" placeholder="ПІБ представника"></td>
                <td class="field-value"><input required form="application" type="text" id="representative-reason" name="representative-reason" placeholder="На підставі чого діє"></td>
            </tr>
            <tr>
                <td class="field-name">Юридична адреса та телефон заявника:</td>
                <td class="field-value auto" colspan="3"><input type="text" readonly form="application" name="j-address" id="j-address" value="<?php print $jAddress;?>" title="<?php print $jAddress; ?>"></td>
                <td class="field-value auto" colspan="2"><input type="tel" readonly form="application" name="tel" id="tel" value="<?php print $tel; ?>" title="<?php print $tel; ?>"></td>
            </tr>
            <tr>
                <td class="field-name"><label for="bank-details">Банківські реквізити заявника:</label></td>
                <td class="field-value" colspan="5"><input required form="application" type="text" id="bank-details" name="bank-details" placeholder="Банківські реквізити заявника"></td>
            </tr>
            <tr>
                <td class="field-name">ЄДРПОУ або РНОКПП(ІПН):</td>
                <td class="field-value auto" colspan="5"><input type="text" readonly form="application" name="edrpou" id="edrpou" value="<?php print $edrpou; ?>" title="<?php print $edrpou; ?>"></td>
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
                    <li><span>Для участі в аукціоні (торгах) покупці сплачують реєстраційний внесок в сумі 375 грн. (без ПДВ).</span></li>
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
                <span class="five-percent">(Гар. внесок 5% суми = <strong class="value">0 грн.</strong>)</span>
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
            <span class="date">Дата: <strong></strong></span>
            <div class="signature">
                <label for="agreed">Усі поля заповнені мною вірно</label>
                <input required form="application" type="checkbox" name="agreed" id="agreed" value="agreed">
                <label for="agreed" class="checkbox"></label>
                <strong><?php print $docsName; ?></strong>
            </div>
        </div>
        <form method="post" action="scripts/php/applicationComplete.php" id="application" name="application">
            <input type="reset" id="reset" name="reset">
            <label for="reset">Очистити всі поля</label>
            <input type="submit" id="submit" name="submit">
            <label for="submit">Надіслати заявку до опрацювання</label>
        </form>
    </section>
</main>
<footer>
    <a class="contacts footer-item" href="../about.php"> <span>Наші контактні дані:</span>
        <br> <img class="contacts-logo" src="SVG/address-book-light.svg"> </a>
    <!--<div class="feedback footer-item"> <span>Залиште свій відгук!</span>-->
        <!--<br> <img src="SVG/bubbles-light.svg" class="feedback-logo"> </div>-->
    <a class="developers footer-item" href="http://www.joncolab.pro"> <span>Site developed by:</span>
        <br> <img class="jonco-logo" src="images/logo-jonco.png"> </a>
    <script>
        $('.feedback').click(function () {
            $('.feedback-form').toggle(300);
            if ($('.feedback-form').css('display') === 'block') {
                $('.feedback-form').css('display', 'flex');
            }
        });
    </script>
</footer>
</body>
</html>