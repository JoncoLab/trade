<?php
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
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
$email = $user->email;
$tel = $user->tel;
$fullName = $user->full_name;
$ver = $user->ver;
$traderId = $user->trader_id;
$docsName = $user->docs_name;
$lots = $user->applied_for_lots;
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
        //= modules/menu.html
        //= modules/logo.html
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
                        <li class="name"><?php print $fullName;?></li>
                        <li class="number"><?php print $tel;?></li>
                        <li class="mail"><?php print $email;?></li>
                        <li class="docs-name"><?php print $docsName;?></li>
                    </ul>
                    <button class="manage">Керувати профілем</button>
                    <button class="add-docs">Додати документи</button>
                    <?php
                    if ($ver === '1') {
                        echo
                            '<div class="trader-id">Ваш реєстраційний номер:' .
                                '<span id="trader-id"> ' . $traderId . '</span>' .
                            '</div>';
                    } else {
                        echo '<div class="trader-id">Ваш обліковий запис ще не верифіковано!</div>';
                    }
                    ?>
                </section>
                <section class="access">
                    <h2>Доступ до торгів</h2>
                    <div class="accessable">
                        <p>
                            <span>Номери лотів:</span><br>
                            <strong><?php print $lots;?></strong>
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
    //= modules/footer.html
</body>
</html>