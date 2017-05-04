<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 01.05.2017
 * Time: 19:45
 */

session_start();
if ($_SESSION["id"] !== 'ADMIN') {
    session_unset();
    session_destroy();
    header('Location: /index.php');
    die();
}
mb_internal_encoding("UTF-8");
if (isset($_POST["id"])) {
    $host = 'joncolab.mysql.ukraine.com.ua';
    $username = 'joncolab_saladin';
    $password = '2014';
    $db = 'joncolab_trade';

    $connection = new mysqli($host, $username, $password, $db);
    if ($connection->connect_error) {
        die('База даних не може опрацювати запит зараз, спробуйте за кілька хвилин');
    }
    $connection->set_charset('utf8');

    $sql = 'UPDATE registered SET access=FALSE WHERE id=\'' . $_POST["id"] . '\'';
    $connection->query($sql);
    $connection->close();
    echo '<button class="allow-access" onclick="allowAccess($(this));">Допустити</button>';

}
exit();