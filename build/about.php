<?php
header('Location: cabinet.php');
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
require_once "scripts/php/user.php";
$user = User::getUserById($_SESSION["id"]);
$_SESSION["ver"] = $user->ver;
$_SESSION["access"] = $user->access;
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>EXChange - про компанію</title>
    <link href="styles/common.css" rel="stylesheet">
    <link href="styles/about.css" rel="stylesheet">
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
    <div class="info">
        <section class="company">
            <h2>Про нас</h2>
            <p>Some text to present the conpany</p>
            <p>Some text to present the conpany</p>
            <p>Some text to present the conpany</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany. Some text to present the conpany. Some text to present the conpany.</p>
            <p>Some text to present the conpany. Some text to present the conpany.</p>
        </section>
        <section class="docs">
            <h2>Юридична інформація</h2>
            <figure>
                <img src="images/logo.png" alt="Сертифікат">
                <figcaption>Sertificate or doc to embed</figcaption>
            </figure>
            <figure>
                <img src="images/logo.png" alt="Сертифікат">
                <figcaption>Sertificate or doc to embed</figcaption>
            </figure>
            <figure>
                <img src="images/logo.png" alt="Сертифікат">
                <figcaption>Sertificate or doc to embed</figcaption>
            </figure>
        </section>
        <section class="contacts">
            <h2>Контактна інформація</h2>
            <ul>
                <li class="mail">mail</li>
                <li class="phone">mobile</li>
                <li class="fb">facebook</li>
                <li class="address">address</li>
            </ul>
        </section>
    </div>
</main>
<?php
include "assets/footer.html";
?>
</body>
</html>