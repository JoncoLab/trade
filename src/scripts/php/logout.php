<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 23:00
 */

session_start();
session_unset();
session_destroy();
header("Location: /start.html");
exit();
