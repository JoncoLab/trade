<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Trade</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/lots-style.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/script.js"></script>
</head>

<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Логотип">
            <h1>Назва компанії</h1>
        </div>
        <!--<div class="reg-log">-->
            <!--<button class="login">Увійти</button>-->
            <!--<button class="signup">Зареєструватися</button>-->
            <!--<dialog class="login" open>-->
                <!--<form class="login-form">-->
                    <!--<label for="login">Ваш логін:</label>-->
                    <!--<input required type="email" name="login" id="login" placeholder="Ваш логін (ел. пошта)" autocomplete="on">-->
                    <!--<label for="password-in">Ваш пароль:</label>-->
                    <!--<input required type="password" name="password-in" id="password-in" placeholder="Ваш пароль" required>-->
                    <!--<label for="remember">-->
                        <!--<div class="checkbox"></div><span>Запам'ятати мене</span> </label>-->
                    <!--<input type="checkbox" id="remember" name="remember" checked>-->
                    <!--<input type="submit" value="Увійти до кабінету">-->
                <!--</form>-->
                <!--<script>-->
                    <!--$(document).ready(function () {-->
                        <!--$('button.login').click(function () {-->
                            <!--$('dialog.login').fadeToggle(300);-->
                        <!--});-->
                        <!--$('label[for="remember"]').click(function () {-->
                            <!--$(this).children('.checkbox').toggleClass('checked');-->
                        <!--});-->
                    <!--});-->
                <!--</script>-->
            <!--</dialog>-->
            <!--<dialog class="signup"></dialog>-->
        <!--</div>-->
    </header>
    <main>
        <menu class="main-menu"> <img class="menu-icon" src="SVG/menu.svg"> <span>Меню</span>
            <ul class="menu">
                <li><img class="ico" src="SVG/user-light.svg"><a href="cabinet-page.php">Мій кабінет</a></li>
                <li><img class="ico" src="SVG/hammer2-light.svg"><a href="auction.html">Аукціон</a></li>
                <li><img class="ico" src="SVG/office-light.svg"><a href="about.html">Про компанію</a></li>
                <li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.html">Новини проекту</a></li>
                <li><img class="ico" src="SVG/book-light.svg"><a href="rules.html">Правила та умови</a></li>
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
        <div class="lots">
            <ul class="lot-list">
                <h2>Список наявних лотів</h2>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
                <li class="lot">
                    <img src="images/drova.png">
                    <article>
                        <h3>Мій перший лот<small>Початок торгів</small></h3>
                        <p class="description">The first paragraph</p>
                        <p class="description">The second paragraph. The second paragraph. The second paragraph. The second paragraph</p>
                        <p class="description">The <strong>third</strong> paragraph.</p>
                        <p class="description">The fourth paragraph is probably the first paragraph you won't ever read</p>
                        <p class="description">The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. The fifth paragraph. </p>
                    </article>
                    <a class="apply" href="application.html">Подати заяву</a>
                </li>
            </ul>
        </div>
        <form action="scripts/php/mail.php" method="post" class="feedback-form" id="feedback">
            <label for="name">Ваше ім'я</label>
            <input type="text" name="name" id="name" placeholder="Семен" required autofocus>
            <label for="email">Ваша електронна адреса</label>
            <input type="email" name="email" id="email" placeholder="zrazok@joncolab.pro" required>
            <label for="message">Ваш коментар</label>
            <textarea rows="5" placeholder="Введіть ваше повідомлення" maxlength="1000" id="text" name="message" id="message" required></textarea>
            <fieldset class="buttons">
                <label for="reset">Очистити</label>
                <input type="reset" id="reset" name="reset" value="Очистити">
                <label for="submit">Надіслати</label>
                <input type="submit" id="submit" name="submit" value="Надіслати">
            </fieldset>
        </form>
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