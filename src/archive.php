<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 23:01
 */
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}
require_once "scripts/php/user.php";
$id = $_SESSION["id"];
$user = User::getUserById($id);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXChange - архів заявок</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/archive.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/common.js"></script>
</head>
<body>
<header>
    //= modules/menu.html
    //= modules/logo.html
</header>
<main>
    <section class="content">
        <h2>Архів заявок</h2>
        <ul class="applications">
            <?php
            $applications = scandir('docs/' . $user->trader_id . '/');
            $applications = array_diff($applications, ['.', '..']);
            $applications = array_values($applications);
            foreach ($applications as $application) {
                $year = substr($application, 0, 4);
                $day = substr($application, 8, 2);
                $month = substr($application, 5, 2);
                $name = $day . '.' . $month . '.' . $year;
                echo
                '<li class="application">' .
                '<span class="name">Заявка від ' . $name . '</span>' .
                '<a class="download" href="docs/' . $user->trader_id . '/' . $application . '">Завантажити</a>' .
                '<button class="open">Відкрити</button>' .
                '</li>';
            }
            ?>
        </ul>
    </section>
</main>
//= modules/footer.html
</body>
</html>
