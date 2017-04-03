<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 16.01.2017
 * Time: 7:36
 */

$pass = '1234';
echo $_POST["pass"] === $pass ? '+' : '-';
exit();