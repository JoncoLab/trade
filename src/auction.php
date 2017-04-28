<?php
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}
require_once "scripts/php/user.php";
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
$sql = 'SELECT session_active FROM trade';
$result = $connection->query($sql)->fetch_assoc();
$active = $result["session_active"];

if ($active == 0) {
    header('refresh: 15; url="http://exchange.roik.pro/auction.php"');
}
$id = $_SESSION["id"];
$user = User::getUserById($id);
$connection->close();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXChange - торги</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/auction.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js"></script>
    <?php
    if ($active == 1) {
        echo '<script src="scripts/js/auction.js"></script>';
    }
    ?>
</head>
<body class="<?php if ($active == 0) { print 'closed'; } ?>">
<p id="auction-closed">
    <span>На даний момент сесія торгів завершена.</span><br>
    <span>Інформацію щодо наступної сесії можна переглянути у</span><br>
    <a href="cabinet.php"><img src="SVG/user-light.svg">Вашому кабінеті</a>
</p>
<div id="fullscreen">
    <h1>Для зручності буде відкрито повноекранний режим</h1>
    <button class="fullscreen" autofocus>ОК</button>
</div>
<header>
    //= modules/menu.html
    //= modules/logo.html
    <div class="additional">
        <div class="clock"></div>
        <div class="trader-id"><?php print $user->trader_id;?></div>
        <div class="self-online-status"></div>
    </div>
</header>
<main>
    <section class="info">
        <div class="stream">
            <img src="http://ztsb.org.ua/uploads/images/logo.png">
        </div>
        <div class="chat">
            <h2>Повідомлення адміністратора торгу</h2>
            <div class="messages">
                <div class="wrapper"></div>
            </div>
        </div>
    </section>
    <section class="trade">
        <table class="auction-table"></table>
        <div class="actions">
            <div class="action take-part">
                <button class="take-part">Торгуватися</button>
            </div>
            <div class="action leave">
                <button class="leave">Не торгуватися</button>
            </div>
            <div class="action raise steps">
                <div class="fieldset">
                    <label for="raise-to-steps">Підвищити  ще на </label>
                    <input type="number" name="raise-to-steps" id="raise-to-steps" min="1" max="100" step="1">
                    <label for="raise-to-steps">крок(-ів)</label>
                </div>
                <button class="raise-to-steps">Підтвердити</button>
            </div>
            <div class="action raise amount">
                <div class="fieldset">
                    <label for="raise-to-amount">Підвищити до </label>
                    <input type="number" name="raise-to-amount" id="raise-to-amount" min="" max="10000" step="10">
                    <label for="raise-to-amount">грн.</label>
                </div>
                <button class="raise-to-price">Підтвердити</button>
            </div>
        </div>
        <div class="users-online">
            <h2>Користувачі в мережі:</h2>
            <ul class="users"></ul>
        </div>
    </section>
</main>
</body>
</html>