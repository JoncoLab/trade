<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 13.12.2016
 * Time: 5:16
 */
mb_internal_encoding("UTF-8");
session_start();
require_once "user.php";
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$dbPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $dbPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних');
}
$connection->set_charset('utf-8');
$sql = 'SELECT * FROM settings';
$settings = $connection->query($sql)->fetch_assoc();
$connection->close();

if (isset($_POST["submit"])) {
    $status = $_POST["status-button"];
    $full_name = $_POST["full-name"];
    $j_address =
        $_POST["j-zip"] . ', ' .
        $_POST["j-country"] . ', ' .
        $_POST["j-region"] . ' область, ';
    if ($_POST["j-district"] !== '') {
        $j_address .= $_POST["j-district"] . ' район, ';
    }
    $j_address .=
        $_POST["j-city"] . ', вул. ' .
        $_POST["j-street"] . ', ' .
        $_POST["j-streetnum"];
    if ($_POST["j-doornum"] !== '') {
        $j_address .= '/' . $_POST["j-doornum"];
    }

    $edrpou = $_POST["edrpou"];
    $ind = $_POST["ind"];
    $person = $_POST["person"];
    $reason = $_POST["reason"];
    $short_name = $_POST["short-name"];
    $head = $_POST["head"];
    $tel = $_POST["number"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $docs_name = $_POST["docs-name"];
    $post_address =
        $_POST["zip"] . ', ' .
        $_POST["country"] . ', ' .
        $_POST["region"] . ' область, ';
    if ($_POST["district"] !== '') {
        $post_address .= $_POST["district"] . ' район, ';
    }
    $post_address .=
        $_POST["city"] . ', вул. ' .
        $_POST["street"] . ', ' .
        $_POST["streetnum"];
    if ($_POST["doornum"] !== '') {
        $post_address .= '/' . $_POST["doornum"];
    }

    if ($_POST["zip"] === '' || $_POST["country"] === '' || $_POST["region"] === '' || $_POST["city"] === '' || $_POST["street"] === '' || $_POST["streetnum"] === '' || $_POST["doornum"] === '') {
        $post_address = '';
    }

    $user = User::registerUser($status, $full_name, $j_address, $edrpou, $ind, $person, $reason, $short_name, $head, $tel, $email, $password, $docs_name, $post_address);
    $_SESSION['id'] = $user->id;

    $p = "\r\n";
    $to = $settings["to"];
    $subject = 'Новий користувач';
    $boundary = md5(date('r', time()));
    $headers = 'From: EXChange <no-reply@exchange.roik.pro>' . $p;
    $headers .= 'MIME-Version: 1.0' . $p;
    $headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"; charset="utf-8"' . $p;
    $message = 'Зареєстрованому користувачу присвоєно номер ' . $user->id . $p . $p;
    $message .= 'Він вказав про себе наступну інформацію:' . $p;
    $message .= '1) Він - ' . $status . ';' . $p;
    $message .= '2) Повна назва: ' . $full_name . ';' . $p;
    $message .= '3) Скорочена назва: ' . $short_name . ';' . $p;
    $message .= '4) Назва для документів: ' . $docs_name . ';' . $p;
    $message .= '5) В особі: ' . $person . ';' . $p;
    $message .= '6) Діє на підставі: ' . $reason . ';' . $p;
    if ($status == 'Юридична особа') {
        $message .= '7) Директор: ' . $head . ';' . $p;
        $message .= '8) Контактний телефон: ' . $tel . ';' . $p;
        $message .= '9) Електронна пошта: ' . $email . ';' . $p;
        $message .= '10) Юридична адреса: ' . $j_address . ';' . $p;
        $message .= ($post_address == '') ? ('Поштову адресу не вказав.' . $p) : ('11) Поштова адреса: ' . $post_address . '.' . $p);
    } else {
        $message .= '7) Контактний телефон: ' . $tel . ';' . $p;
        $message .= '8) Електронна пошта: ' . $email . ';' . $p;
        $message .= '9) Юридична адреса: ' . $j_address . ';' . $p;
        $message .= ($post_address == '') ? ('Поштову адресу не вказав.' . $p) : ('10) Поштова адреса: ' . $post_address . '.' . $p);
    }
    $message .= 'До листа додані документи, що прикріпив користувач.';
    if ($status == 'Фізична особа-підприємець') {
        $paths = array(
            $_FILES["docs-letter"]["tmp_name"],
            $_FILES["docs-accept-personal-info-usage"]["tmp_name"],
            $_FILES["docs-state-register"]["tmp_name"],
            $_FILES["docs-passport"]["tmp_name"],
            $_FILES["docs-taxes"]["tmp_name"],
            $_FILES["docs-permission"]["tmp_name"],
            $_FILES["docs-money"]["tmp_name"]
        );
        $files = array(
            basename($_FILES["docs-letter"]["name"]),
            basename($_FILES["docs-accept-personal-info-usage"]["name"]),
            basename($_FILES["docs-state-register"]["name"]),
            basename($_FILES["docs-passport"]["name"]),
            basename($_FILES["docs-taxes"]["name"]),
            basename($_FILES["docs-permission"]["name"]),
            basename($_FILES["docs-money"]["name"])
        );
        $names = array(
            'Лист',
            'Опрацювання персональних',
            'Витяг з ЄДР',
            'Копії документів',
            'Податковий витяг',
            'Дозвіл',
            'Довідка'
        );
    } else {
        $paths = array(
            $_FILES["docs-letter"]["tmp_name"],
            $_FILES["docs-accept-personal-info-usage"]["tmp_name"],
            $_FILES["docs-state-register"]["tmp_name"],
            $_FILES["docs-statute"]["tmp_name"],
            $_FILES["docs-boss"]["tmp_name"],
            $_FILES["docs-taxes"]["tmp_name"],
            $_FILES["docs-permission"]["tmp_name"],
            $_FILES["docs-money"]["tmp_name"]
        );
        $files = array(
            basename($_FILES["docs-letter"]["name"]),
            basename($_FILES["docs-accept-personal-info-usage"]["name"]),
            basename($_FILES["docs-state-register"]["name"]),
            basename($_FILES["docs-statute"]["name"]),
            basename($_FILES["docs-boss"]["name"]),
            basename($_FILES["docs-taxes"]["name"]),
            basename($_FILES["docs-permission"]["name"]),
            basename($_FILES["docs-money"]["name"])
        );
        $names = array(
            'Лист',
            'Опрацювання персональних',
            'Витяг з ЄДР',
            'Статут',
            'Керівник',
            'Податковий витяг',
            'Дозвіл',
            'Довідка'
        );
    }
    $multipartMessage = '--' . $boundary . $p;
    $multipartMessage .= 'Content-Type: text/plain; charset="utf-8"' . $p;
    $multipartMessage .= 'Content-Transfer-Encoding: bit7' . $p . $p;
    $multipartMessage .= $message . $p . $p;

    foreach ($files as $index => $file) {
        $spl = new SplFileInfo($file);
        $newName = $names[$index] . '.' . $spl->getExtension();
        $multipartMessage .= '--' . $boundary . $p;
        $multipartMessage .= 'Content-Type: application/octet-stream; name=' . $file . $p;
        $multipartMessage .= 'Content-Transfer-Encoding: base64' . $p;
        $multipartMessage .= 'Content-Disposition: attachment; filename="' . $newName . '"' . $p . $p;
        $multipartMessage .= chunk_split(base64_encode(file_get_contents($paths[$index]))) . $p;
    }

    $multipartMessage .= '--' . $boundary . '--' . $p;

    if (mail($to, $subject, $multipartMessage, $headers)) {
        $to = 'Customer <' . $email . '>';
        $subject = 'Реєстрація на EXChange';
        $headers = 'From: EXChange <no-reply@exchange.roik.pro>';
        $message = 'Доброго дня!' . $p . $p;
        $message .= 'Ви успішно зареєструвалися на торговому майданчику EXChange.' . $p;
        $message .= 'Верифікація та перевірка вказаних вами даних буде здійснена нашим менеджером найближчим часом.' . $p;
        $message .= 'У випадку успішної реєстраціїї вам буде надо доступ до формування заявки.';
        wordwrap($message, 70, $p);
        if (!mail($to, $subject, $message, $headers)) {
            die('Проблема з поштовою скринькою, спробуйте пізніше!');
        }
        header("Location: /cabinet.php");
    } else {
        die('Проблема з поштовою скринькою, спробуйте пізніше!');
    }
} else {
    die("Do not break my site!");
}