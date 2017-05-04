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

$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
}
$connection->set_charset('utf8');
$sql = 'SELECT * FROM settings';
$settings = $connection->query($sql)
    ->fetch_assoc();
$id = $_SESSION['id'];
$user = User::getUserById($id);
$_SESSION["ver"] = $user->ver;
$_SESSION["access"] = $user->access;
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>ExChange - особистий кабінет</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/cabinet.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js"></script>
    <script src="scripts/js/cabinet.js"></script>
</head>
<body>
<header>
    <?php
    include "assets/menu.php";
    include "assets/logo.html";
    ?>
    <div class="additional">
        <div class="clock"></div>
    </div>
</header>
<main>
    <div class="cabinet-content">
        <div class="layout">
            <section class="my-info">
                <h2>Ваші дані</h2>
                <ul>
                    <li class="name"><?php print $user->full_name;?></li>
                    <li class="number"><?php print $user->tel;?></li>
                    <li class="mail"><?php print $user->email;?></li>
                    <li class="docs-name"><?php print $user->docs_name;?></li>
                </ul>
                <button class="manage">Керувати профілем</button>
                <button class="add-docs">Додати документи</button>
                <?php
                if ($user->ver === '1') {
                    echo
                        '<div class="trader-id">Ваш реєстраційний номер:' .
                        '<span id="trader-id"> ' . $user->trader_id . '</span>' .
                        '</div>';
                } else {
                    echo '<div class="trader-id">Ваш обліковий запис ще не верифіковано!</div>';
                }
                ?>
            </section>
            <section class="access">
                <h2>Доступ до торгів</h2>
                <p class="access-state <?php print ($user->access == 0 ? 'denied' : 'allowed');?>">
                    <?php
                    print ($user->access == 0 ?
                        'Вас не допущено до торгів. Для з\'ясування деталей зверніться до менеджерів' :
                        'Вас успішно допущено до торгів. Гарної торгівлі.');
                    ?>
                </p>
                <div class="accessable">
                    <p>
                        <?php
                        echo ($user->applied_for_lots == '' ?
                            '<strong>Ви ще не заявилися на жоден лот!</strong>' :
                            ('<span>Номери лотів:</span><br>' .
                                '<strong>' . $user->applied_for_lots . '</strong>'));
                        ?>
                    </p>
                    <p>
                        <span>Початок наступної cесії:</span><br>
                        <strong><?php print $settings["next_session"]?></strong>
                    </p>
                </div>
            </section>
        </div>
        <section id="load-docs">
            <div class="files">
            </div>
            <div class="actions">
                <label for="files">Виберіть файли з комп'ютера</label>
                <input type="file" name="files[]" id="files" value="Завантажити" form="send-docs" multiple required>
                <label for="reset">Очистити</label>
                <input type="reset" name="reset" id="reset" value="Очистити" form="send-docs">
            </div>
            <form method="post" id="send-docs" name="send-docs" enctype="multipart/form-data" action="scripts/php/addDocs.php">
                <input type="hidden" name="id" value="<?php print $user->id;?>">
                <label for="submit">Прикріпити та надіслати завантажені документи</label>
                <input type="submit" name="submit" id="submit" value="Прикріпити та надіслати завантажені документи">
            </form>
        </section>
    </div>
</main>
<?php
include "assets/footer.html";
?>
</body>
</html>