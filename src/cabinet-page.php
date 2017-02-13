<?php
session_start();
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$tel = $_SESSION['tel'];
$fullName = $_SESSION['full_name'];
$ver = $_SESSION['ver'];
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Trade</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/cabinet-page.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/script.js"></script>
    <script src="scripts/js/cabinet.js"></script>
</head>

<body>
    <header>
        //= modules/logo.html
    </header>
    <main>
        //= modules/menu.html
        <div class="cabinet-content">
            <div class="layout">
                <section class="my-info">
                    <h2>Ваші дані</h2>
                    <ul>
                        <li class="name"><?php print $fullName;?></li>
                        <li class="number"><?php print $tel;?></li>
                        <li class="mail"><?php print $email;?></li>
                    </ul>
                    <button class="add-docs">Додати документи</button>
                    <?php
                    if ($ver === 1) {
                        echo '<div class="user-id">Ваш реєстраційний номер: <span id="user-id">123</span></div>';
                    } else {
                        echo '<div class="user-id">Ваш обліковий запис ще не верифіковано!</div>';
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
        //= modules/feedback-form.html
    </main>
    //= modules/footer.html
</body>
</html>