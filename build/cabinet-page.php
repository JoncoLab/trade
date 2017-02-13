<?php
session_start();
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
        <div class="logo">
            <img src="images/logo.png" alt="Логотип">
            <h1>EXChange</h1>
        </div>
    </header>
    <main>
        <menu class="main-menu"> <img class="menu-icon" src="SVG/menu.svg"> <span>Меню</span>
            <ul class="menu">
                <li><img class="ico" src="SVG/user-light.svg"><a href="cabinet-page.php">Мій кабінет</a></li>
                <li><img class="ico" src="SVG/hammer2-light.svg"><a href="auction.php">Аукціон</a></li>
                <li><img class="ico" src="SVG/office-light.svg"><a href="about.html">Про компанію</a></li>
                <li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.php">Новини проекту</a></li>
                <li><img class="ico" src="SVG/book-light.svg"><a href="rules.html">Правила та умови</a></li>
                <li><img class="ico" src="SVG/doc-light.svg"><a href="application.php">Подати заявку на участь в торгах</a></li>
                <li><img class="ico" src="SVG/archive-light.svg"><a href="archive.php">Архів заявок</a></li>
                <li><img class="ico" src="SVG/#"><a href="logout.php">Вихід</a></li>
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
    <footer>
        <a class="contacts footer-item" href="about.html"> <span>Наші контактні дані:</span>
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