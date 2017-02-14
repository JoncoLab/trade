<?php
/**
 * Created by PhpStorm.
 * User: Saladin
 * Date: 13.02.2017
 * Time: 23:01
 */
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: start.html");
    session_unset();
    session_destroy();
    exit();
}
