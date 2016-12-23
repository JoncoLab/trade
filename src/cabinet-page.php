<?php
session_start();
include('scripts/php/user.php');
$user = User::getUserById($_SESSION["id"]);
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
        //= modules/reg-log.html
    </header>
    <main>
        //= modules/menu.html
        <div class="cabinet-content">
            <div class="layout">
                <section class="my-info">
                    <h2>Ваші дані</h2>
                    <ul>
                        <li class="name"><?php print $user->name;?></li>
                        <li class="number"><?php print $user->number;?></li>
                        <li class="mail"><?php print $user->email;?></li>
                        <li class="registration-date" title="Дата реєстрації">21.01.2017</li>
                    </ul>
                    <button class="add-docs">Додати документи</button>
                    <div class='user-id'>Ваш User id: <span id="user-id"><?php print $user->id?></span></div>
                </section>
                <section class="access">
                    <h2>Доступ до торгів</h2>
                    <ul class="accessable">
                        <li><span class="lot-num">Номер лоту: <strong id="drag1" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag2" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag3" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag4" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag5" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag6" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                        <li><span class="lot-num">Номер лоту: <strong id="drag7" draggable="true">321</strong></span><span class="start">Початок торгів: <time datetime="12:43 21-12-2017"></time></span></li>
                    </ul>
                </section>
            </div>
            <section class="load-docs">
                <div id="drop-files" ondrop="event.preventDefault(); event.stopPropagation(); doDrop(event);"></div>
                <div class="actions">
                    <label for="files">Виберіть файли з комп'ютера</label>
                    <input type="file" name="files" id="files" value="Завантажити" form="send-docs" accept="" multiple required>
                    <label for="reset">Очистити</label>
                    <input type="reset" name="reset" id="reset" value="Очистити" form="send-docs">
                </div>
                <form method="post" id="send-docs" name="send-docs">
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