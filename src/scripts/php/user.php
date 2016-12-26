<?php

class User
{
    var $id;
    var $status;
    var $full_name;
    var $j_address;
    var $edrpou;
    var $ind;
    var $person;
    var $reason;
    var $short_name;
    var $tel;
    var $email;
    var $password;
    var $docs_name;
    var $post_address;
    var $ver = false;


    private function User($id, $status, $full_name, $j_address, $edrpou, $ind, $person, $reason, $short_name, $tel, $email, $password, $docs_name, $post_address) {
        $this->id = $id;
        $this->status = $status;
        $this->full_name = $full_name;
        $this->j_address = $j_address;
        $this->edrpou = $edrpou;
        $this->ind = $ind;
        $this->person = $person;
        $this->reason = $reason;
        $this->short_name = $short_name;
        $this->tel = $tel;
        $this->email = $email;
        $this->password = $password;
        $this->docs_name = $docs_name;
        $this->post_address = $post_address;
    }

    public static function registerUser($status, $full_name, $j_address, $edrpou, $ind, $person, $reason, $short_name, $tel, $email, $password, $docs_name, $post_address) {
        $host = 'joncolab.mysql.ukraine.com.ua';
        $username = 'joncolab_saladin';
        $userPassword = '2014';
        $db = 'joncolab_trade';
        $connection = new mysqli($host, $username, $userPassword, $db);

        if ($connection->connect_error) {
            die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
        } else {
            $sql = 'INSERT INTO registered (status, full_name, `j-address`, edrpou, ind, person, reason, short_name, tel, email, password, docs_name, post_address) VALUES (\'' . $status . '\', \'' . $full_name . '\', \'' . $j_address . '\', \'' . $edrpou . '\', \'' . $ind . '\', \'' . $person . '\', \'' . $reason . '\', \'' . $short_name . '\', \'' . $tel . '\', \'' . $email . '\', \'' . $password . '\', \'' . $docs_name . '\', \'' . $post_address . '\')';
            $connection->query($sql);
            $sql = 'SELECT * FROM registered WHERE email=\'' . $email . '\'';
            $result = $connection->query($sql);
            $currentUser = $result->fetch_assoc();
            $connection->close();
            return new User($currentUser["id"], $currentUser["status"], $currentUser["full_name"], $currentUser["j-address"], $currentUser["edrpou"], $currentUser["ind"], $currentUser["person"], $currentUser["reason"], $currentUser["short_name"], $currentUser["tel"], $currentUser["email"], $currentUser["password"], $currentUser["docs_name"], $currentUser["post_address"]);
        }
    }

    public static function getUserById($id) {
        $host = 'joncolab.mysql.ukraine.com.ua';
        $username = 'joncolab_saladin';
        $userPassword = '2014';
        $db = 'joncolab_trade';
        $connection = new mysqli($host, $username, $userPassword, $db);

        if ($connection->connect_error) {
            die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
        } else {
            $sql = 'SELECT * FROM registered WHERE id=\'' . $id . '\'';
            $result = $connection->query($sql);
            $currentUser = $result->fetch_assoc();
            $connection->close();
            return new User($currentUser["id"], $currentUser["status"], $currentUser["full_name"], $currentUser["j-address"], $currentUser["edrpou"], $currentUser["ind"], $currentUser["person"], $currentUser["reason"], $currentUser["short_name"], $currentUser["tel"], $currentUser["email"], $currentUser["password"], $currentUser["docs_name"], $currentUser["post_address"], $currentUser["ver"]);
        }
    }

    public static function getUserByEmail($email) {
        $host = 'joncolab.mysql.ukraine.com.ua';
        $username = 'joncolab_saladin';
        $userPassword = '2014';
        $db = 'joncolab_trade';
        $connection = new mysqli($host, $username, $userPassword, $db);

        if ($connection->connect_error) {
            die('Не вдається встановити підключення до бази даних:<br>' . $connection->connect_error);
        } else {
            $sql = 'SELECT * FROM registered WHERE email=\'' . $email . '\'';
            $result = $connection->query($sql);
            $currentUser = $result->fetch_assoc();
            $connection->close();
            return new User($currentUser["id"], $currentUser["status"], $currentUser["full_name"], $currentUser["j-address"], $currentUser["edrpou"], $currentUser["ind"], $currentUser["person"], $currentUser["reason"], $currentUser["short_name"], $currentUser["tel"], $currentUser["email"], $currentUser["password"], $currentUser["docs_name"], $currentUser["post_address"], $currentUser["ver"]);
        }
    }
}