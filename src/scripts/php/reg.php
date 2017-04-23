<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 13.12.2016
 * Time: 5:16
 */
mb_internal_encoding("UTF-8");
session_start();
include('user.php');

if (isset($_POST["submit"])) {
    $status = $_POST["status-button"];
    $full_name = $_POST["full-name"];
    $j_address =
        trim($_POST["j-zip"]) . ', ' .
        trim($_POST["j-country"]) . ', ' .
        trim($_POST["j-region"]) . ' область, ';
    if (trim($_POST["j-district"]) !== '') {
        $j_address .= trim($_POST["j-district"]) . ' район, ';
    }
    $j_address .=
        trim($_POST["j-city"]) . ', вул. ' .
        trim($_POST["j-street"]) . ', ' .
        trim($_POST["j-streetnum"]) . '/' .
        trim($_POST["j-doornum"]);

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
        trim($_POST["zip"]) . ', ' .
        trim($_POST["country"]) . ', ' .
        trim($_POST["region"]) . ' область, ';
    if (trim($_POST["district"]) !== '') {
        $post_address .= trim($_POST["district"]) . ' район, ';
    }
    $post_address .=
        trim($_POST["city"]) . ', вул. ' .
        trim($_POST["street"]) . ', ' .
        trim($_POST["streetnum"]) . '/' .
        trim($_POST["doornum"]);

    if (trim($_POST["zip"]) === '' || trim($_POST["country"]) === '' || trim($_POST["region"]) === '' || trim($_POST["city"]) === '' || trim($_POST["street"]) === '' || trim($_POST["streetnum"]) === '' || trim($_POST["doornum"])=== '') {
        $post_address = '';
    }

    $user = User::registerUser($status, $full_name, $j_address, $edrpou, $ind, $person, $reason, $short_name, $head, $tel, $email, $password, $docs_name, $post_address);
    $_SESSION['id'] = $user->id;
    $_SESSION['status'] = $user->status;
    $_SESSION['full_name'] = $user->full_name;
    $_SESSION['j_address'] = $user->j_address;
    $_SESSION['edrpou'] = $user->edrpou;
    $_SESSION['ind'] = $user->ind;
    $_SESSION['person'] = $user->person;
    $_SESSION['reason'] = $user->reason;
    $_SESSION['short_name'] = $user->short_name;
    $_SESSION['head'] = $user->head;
    $_SESSION['tel'] = $user->tel;
    $_SESSION['email'] = $user->email;
    $_SESSION['docs_name'] = $user->docs_name;
    $_SESSION['post_address'] = $user->post_address;
    $_SESSION['ver'] = $user->ver;
    $_SESSION['trader_id'] = $user->trader_id;
    $_SESSION['applied_for_lots'] = $user->applied_for_lots;

    $p = "\r\n";
    $to = 'Jonco Lab <joncolab@gmail.com>';
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
    $message .= '7) Директор: ' . $head . ';' . $p;
    $message .= '8) Контактний телефон: ' . $tel . ';' . $p;
    $message .= '9) Електронна пошта: ' . $email . ';' . $p;
    $message .= '10) Юридична адреса: ' . $j_address . ';' . $p;
    $message .= ($post_address == '') ? ('Поштову адресу не вказав.' . $p) : ('11) Поштова адреса: ' . $post_address . '.' . $p);
    $message .= 'До листа додані документи, що прикріпив користувач.';
    if ($status == 'Фізична особа-підприємець') {
        $paths = array(
            $_FILES["docs-letter"]["tmp_name"],
            $_FILES["docs-blank"]["tmp_name"],
            $_FILES["docs-accept-personal-info-usage"]["tmp_name"],
            $_FILES["docs-state-register"]["tmp_name"],
            $_FILES["docs-passport"]["tmp_name"],
            $_FILES["docs-taxes"]["tmp_name"],
            $_FILES["docs-permission"]["tmp_name"],
            $_FILES["docs-deal"]["tmp_name"],
            $_FILES["docs-money"]["tmp_name"]
        );
        $files = array(
            basename($_FILES["docs-letter"]["name"]),
            basename($_FILES["docs-blank"]["name"]),
            basename($_FILES["docs-accept-personal-info-usage"]["name"]),
            basename($_FILES["docs-state-register"]["name"]),
            basename($_FILES["docs-passport"]["name"]),
            basename($_FILES["docs-taxes"]["name"]),
            basename($_FILES["docs-permission"]["name"]),
            basename($_FILES["docs-deal"]["name"]),
            basename($_FILES["docs-money"]["name"])
        );
        $names = array(
            'Лист',
            'Анкета',
            'Опрацювання персональних',
            'Витяг з ЄДР',
            'Копії документів',
            'Податковий витяг',
            'Дозвіл',
            'Копія договору',
            'Довідка'
        );
    } else {
        $paths = array(
            $_FILES["docs-letter"]["tmp_name"],
            $_FILES["docs-blank"]["tmp_name"],
            $_FILES["docs-accept-personal-info-usage"]["tmp_name"],
            $_FILES["docs-state-register"]["tmp_name"],
            $_FILES["docs-statute"]["tmp_name"],
            $_FILES["docs-boss"]["tmp_name"],
            $_FILES["docs-taxes"]["tmp_name"],
            $_FILES["docs-permission"]["tmp_name"],
            $_FILES["docs-deal"]["tmp_name"],
            $_FILES["docs-money"]["tmp_name"]
        );
        $files = array(
            basename($_FILES["docs-letter"]["name"]),
            basename($_FILES["docs-blank"]["name"]),
            basename($_FILES["docs-accept-personal-info-usage"]["name"]),
            basename($_FILES["docs-state-register"]["name"]),
            basename($_FILES["docs-statute"]["name"]),
            basename($_FILES["docs-boss"]["name"]),
            basename($_FILES["docs-taxes"]["name"]),
            basename($_FILES["docs-permission"]["name"]),
            basename($_FILES["docs-deal"]["name"]),
            basename($_FILES["docs-money"]["name"])
        );
        $names = array(
            'Лист',
            'Анкета',
            'Опрацювання персональних',
            'Витяг з ЄДР',
            'Статут',
            'Керівник',
            'Податковий витяг',
            'Дозвіл',
            'Копія договору',
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