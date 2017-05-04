<menu class="main-menu" xmlns="http://www.w3.org/1999/html">
    <img class="menu-icon" src="../SVG/menu.svg">
    <span>Меню</span>
    <ul class="menu">
        <li><img class="ico" src="../SVG/user-light.svg"><a href="../cabinet.php">Мій кабінет</a></li>
        <!--<li><img class="ico" src="SVG/office-light.svg"><a href="../about.php">Про компанію</a></li>-->
        <!--<li><img class="ico" src="SVG/newspaper-light.svg"><a href="articles.php">Новини проекту</a></li>-->
        <li><img class="ico" src="../SVG/book-light.svg"><a href="../rules.php">Правила та умови</a></li>
        <?php
        if ($_SESSION["ver"] == 1) {
            echo
                '<li><img class="ico" src="../SVG/doc-light.svg"><a href="../application.php">Подати заявку на участь в торгах</a></li>' .
                '<li><img class="ico" src="../SVG/archive-light.svg"><a href="../archive.php">Архів заявок</a></li>';
            if ($_SESSION["access"] == 1) {
                echo '<li><img class="ico" src="../SVG/hammer2-light.svg"><a href="../auction.php">Аукціон</a></li>';
            }
        }
        ?>
        <li><img class="ico" src="../SVG/exit-light.svg"><a href="../scripts/php/logout.php">Вихід</a></li>
    </ul>
</menu>