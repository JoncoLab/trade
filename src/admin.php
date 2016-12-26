<?php
$host = 'joncolab.mysql.ukraine.com.ua';
$username = 'joncolab_saladin';
$userPassword = '2014';
$db = 'joncolab_trade';
$connection = new mysqli($host, $username, $userPassword, $db);

if ($connection->connect_error) {
    die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
} else {
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="styles/admin-style.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="scripts/js/jquery-3.1.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="scripts/js/admin-script.js"></script>
</head>

<body>
    <header>
        <nav class="navbar">
            <button>Лоти</button>
            <button id="users">Користувачі</button>
            <button id="write-article">Статті</button>
        </nav>
    </header>
    <main>
        <div class="lots page-maker"> </div>
        
        <table class="users page-maker active">
            
            <thead>
                <tr class="sum">
                    <th class="total">Всього: <span id="total">
                            <?php
                            $sql = 'SELECT * FROM registered';
                            $users = $connection->query($sql);
                            print $users->num_rows;
                            ?></span>
                    </th>
                    <th class="total-verified">Верифікованих: <span id="total-verified">
                            <?php
                            $sql = 'SELECT * FROM registered WHERE ver=\'1\'';
                            $users = $connection->query($sql);
                            print $users->num_rows;
                            ?></span>
                    </th>
                </tr>
                <tr>
                    <th class="id">ID</th>
                    <th class="status">Акредитація</th>
                    <th class="full-name">Повна назва</th>
                    <th class="j-address">Юридична адреса</th>
                    <th class="adrpou">ЄДРПОУ</th>
                    <th class="ind">Індентифікаційний</th>
                    <th class="person">В особі</th>
                    <th class="reason">Яка діє на підставі</th>
                    <th class="short-name">Скорочена назва</th>
                    <th class="tel">Телефон</th>
                    <th class="email">Логін</th>
                    <th class="docs-name">Скорочено для документів</th>
                    <th class="post-address">Поштова адреса</th>
                    <th class="ver">Стан верифікації</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = 'SELECT * FROM registered';
            $users = $connection->query($sql);
            while ($user = $users->fetch_assoc()) {
                echo
                    '<tr>' .
                    '<td class="id">' . $user["id"] . '</td>' .
                    '<td class="status">' . $user["status"] . '</td>' .
                    '<td class="full-name">' . $user["full_name"] . '</td>' .
                    '<td class="j-address">' . $user["j-address"] . '</td>' .
                    '<td class="edrpou">' . $user["edrpou"] . '</td>' .
                    '<td class="ind">' . $user["ind"] . '</td>' .
                    '<td class="person">' . $user["person"] . '</td>' .
                    '<td class="reason">' . $user["reason"] . '</td>' .
                    '<td class="short-name">' . $user["short_name"] . '</td>' .
                    '<td class="tel">' . $user["tel"] . '</td>' .
                    '<td class="email">' . $user["email"] . '</td>' .
                    '<td class="docs-name">' . $user["docs_name"] . '</td>' .
                    '<td class="post-address">' . $user["post_address"] . '</td>' .
                    '<td class="ver">' . $user["ver"] . '</td>' .
                    '</tr>';
            }
            }
            $connection->close();
            ?>
            </tbody>
        </table>
        
        <form method="post" class="write-article page-maker">
            <button type="button" class="send-article" style="margin: 0 10px ">Надіслати статтю</button>
            <button type="button" class="watch" style="margin: 10px">Проглянути</button>
            <fieldset class=" header">
                <legend>Введіть заголовок:</legend>
                <input type="text" name="header" placeholder="Mama" id="header" tabindex="1"></fieldset>
            <fieldset class=" content">
                <legend>Напишіть статтю:</legend>
                <textarea rows="10" placeholder="you know what to do.." autofocus tabindex="2"></textarea>
                <button class="add-paragr" type="button">Додати абзац</button>
                <button type="button" class="clear">Очистити</button>
                <br>

            </fieldset>
            <fieldset class=" files">
                <legend>Приєднайте щось до неї:</legend>
                <label>Завантажте файл сюди:
                    <input type="file" id="upload-smth" multiple>
                    <button class="reset-upload" type="reset">Удалить</button>
                </label>
            </fieldset>

        </form>
    </main>
</body>

</html>