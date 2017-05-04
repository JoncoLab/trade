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
    header("Location: index.php");
    exit();
}
if ($_SESSION["id"] == 'ADMIN') {
    header('Location: admin/admin.php');
}
require_once "scripts/php/user.php";
$id = $_SESSION["id"];
$user = User::getUserById($id);
$_SESSION["ver"] = $user->ver;
$_SESSION["access"] = $user->access;
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
    <?php
    include "assets/menu.php";
    include "assets/logo.html";
    ?>
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
                $hour = substr($application, 11, 2);
                $min = substr($application, 14, 2);
                $name = $day . '.' . $month . '.' . $year . ' ' . $hour . ':' . $min;
                echo
                '<li class="application">' .
                '<span class="name">Заявка від ' . $name . '</span>' .
                '<a class="download" href="docs/' . $user->trader_id . '/' . $application . '">Завантажити</a>' .
                '</li>';
            }
            ?>
        </ul>
    </section>
</main>
<?php
include "assets/footer.html";
?>
</body>
</html>
