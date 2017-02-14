<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: start.html");
    session_unset();
    session_destroy();
    exit();
}
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$tel = $_SESSION['tel'];
$fullName = $_SESSION['full_name'];
$ver = $_SESSION['ver'];
$traderId = $_SESSION['trader_id'];
$docsName = $_SESSION['docs_name'];
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>ExChange - особистий кабінет</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/cabinet-page.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/script.js"></script>
    <script src="scripts/js/cabinet.js"></script>
</head>

<body>
    <header>
        //= modules/menu.html
        //= modules/logo.html
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
                    <?php
                    if ($ver === '1') {
                        echo
                            '<button class="add-docs">Додати документи</button>' .
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
                    <ul class="accessable">
                        <li><span class="lot-num">Номер лоту: <strong id="drag1">321</strong></span><span class="start">Початок cесії: <time datetime="12:43 21-12-2017"></time></span></li>
                    </ul>
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
                <form method="post" id="send-docs" name="send-docs" enctype="multipart/form-data">
                    <label for="submit">Прикріпити та надіслати завантажені документи</label>
                    <input type="submit" name="submit" id="submit" value="Прикріпити та надіслати завантажені документи">
                </form>
            </section>
        </div>
    </main>
    //= modules/footer.html
</body>
</html>