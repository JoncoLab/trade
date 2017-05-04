<?php
session_start();
if (isset($_SESSION["id"])) {
    if ($_SESSION["id"] == 'ADMIN') {
        header('Location: admin/admin.php');
    } else {
        header('Location: cabinet.php');
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>EXChange - вхід</title>
    <link href="styles/log.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="scripts/js/log.js"></script>
</head>
<body>
<main>
    <form action="scripts/php/log.php" method="post" id="login-form">
        <h1>Увійти до кабінету<br><small><a href="reg.php">Ще не зареєстровані?</a></small></h1>
        <p class="error-data">Неправильно введені дані!</p>
        <div class="form-item">
            <label for="login">Ваш логін:</label>
            <input type="email" name="login" id="login" placeholder="Ваш логін (ел. пошта)" required autocomplete="on">
        </div>
        <div class="form-item">
            <label for="password">Ваш пароль:</label>
            <input type="password" name="password" id="password" placeholder="Ваш пароль" required>
        </div>
        <div class="buttons">
            <input type="submit" name="submit" value="Увійти" id="submit">
            <input type="reset" name="reset" value="Скинути дані" id="reset">
        </div>
    </form>
</main>
</body>
</html>