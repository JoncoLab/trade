<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 24.04.2017
 * Time: 1:04
 */
session_start();
if (!isset($_SESSION["id"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
mb_internal_encoding("UTF-8");
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
}
$connection->set_charset('utf8');
$sql = 'SELECT * FROM settings';
$settings = $connection->query($sql)->fetch_assoc();
$connection->close();
require_once "user.php";
$id = $_POST["id"];
$user = User::getUserById($id);

$p = "\r\n";
$to = $settings["to"];
$subject = 'Додаткові документи';
$boundary = md5(date('r', time()));
$headers = 'From: ' . $user->short_name . ' <' . $user->email . '>' . $p;
$headers .= 'MIME-Version: 1.0' . $p;
$headers .= 'Content-Type: multipart/mixed; boundary="' . $boundary . '"; charset="utf-8"' . $p;
$message = 'Користувач №' . $user->id . ' надіслав документи зі свого кабінету.' . $p . $p;
wordwrap($message, 70, $p);
$multipartMessage = '--' . $boundary . $p;
$multipartMessage .= 'Content-Type: text/plain; charset="utf-8"' . $p;
$multipartMessage .= 'Content-Transfer-Encoding: bit7' . $p . $p;
$multipartMessage .= $message . $p . $p;
for ($i = 0; $i < count($_FILES["files"]["name"]); $i++) {
    $spl = new SplFileInfo(basename($_FILES["files"]["name"][$i]));
    $newName = 'Документ-' . ($i + 1) . '.' . $spl->getExtension();
    $multipartMessage .= '--' . $boundary . $p;
    $multipartMessage .= 'Content-Type: application/octet-stream; name=' . basename($_FILES["files"]["name"][$i]) . $p;
    $multipartMessage .= 'Content-Transfer-Encoding: base64' . $p;
    $multipartMessage .= 'Content-Disposition: attachment; filename="' . $newName . '"' . $p . $p;
    $multipartMessage .= chunk_split(base64_encode(file_get_contents($_FILES["files"]["tmp_name"][$i]))) . $p;
}
$multipartMessage .= '--' . $boundary . '--' . $p;

if (mail($to, $subject, $multipartMessage, $headers)) {
    $to = $user->email;
    $subject = 'Додані документи';
    $headers = 'From: EXChange <no-reply@exchange.roik.pro>';
    $message = 'Доброго дня!' . $p . $p;
    $message .= 'Надіслані вами документи прийняті до розгляду.';
    wordwrap($message, 70, $p);
    if (!mail($to, $subject, $message, $headers)) {
        die('Проблема з поштовою скринькою, спробуйте пізніше!');
    }
    header("Location: /cabinet.php");
} else {
    die('Проблема з поштовою скринькою, спробуйте пізніше!');
}