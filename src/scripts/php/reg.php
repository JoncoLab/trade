<?php
/**
 * Created by PhpStorm.
 * User: NeoNemo
 * Date: 13.12.2016
 * Time: 5:16
 */
session_start();
include('user.php');

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
header("Location: /cabinet.php");
