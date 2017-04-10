<?php
mb_internal_encoding("UTF-8");

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
    var $head;
    var $tel;
    var $email;
    var $password;
    var $docs_name;
    var $post_address;
    var $ver;
    var $trader_id;
    var $applied_for_lots;

    private function User($id, $status, $full_name, $j_address, $edrpou, $ind, $person, $reason, $short_name, $head, $tel, $email, $password, $docs_name, $post_address, $ver, $trader_id, $applied_for_lots)
    {
        $this->id = $id;
        $this->status = $status;
        $this->full_name = $full_name;
        $this->j_address = $j_address;
        $this->edrpou = $edrpou;
        $this->ind = $ind;
        $this->person = $person;
        $this->reason = $reason;
        $this->short_name = $short_name;
        $this->head = $head;
        $this->tel = $tel;
        $this->email = $email;
        $this->password = $password;
        $this->docs_name = $docs_name;
        $this->post_address = $post_address;
        $this->ver = $ver;
        $this->trader_id = $trader_id;
        $this->applied_for_lots = $applied_for_lots;
    }

    public static function registerUser($status, $full_name, $j_address, $edrpou, $ind, $person, $reason, $short_name, $head, $tel, $email, $password, $docs_name, $post_address)
    {
        $connection = self::connectToDB();
        $sql = 'INSERT INTO registered (status, full_name, `j-address`, edrpou, ind, person, reason, short_name, head, tel, email, password, docs_name, post_address) VALUES (\'' . $status . '\', \'' . $full_name . '\', \'' . $j_address . '\', \'' . $edrpou . '\', \'' . $ind . '\', \'' . $person . '\', \'' . $reason . '\', \'' . $short_name . '\', \'' . $head . '\', \'' . $tel . '\', \'' . $email . '\', \'' . $password . '\', \'' . $docs_name . '\', \'' . $post_address . '\')';
        $connection->query($sql);
        $sql = 'SELECT * FROM registered WHERE email=\'' . $email . '\'';
        $result = $connection->query($sql);
        $connection->close();
        $currentUser = $result->fetch_assoc();
        return new User($currentUser["id"], $currentUser["status"], $currentUser["full_name"], $currentUser["j-address"], $currentUser["edrpou"], $currentUser["ind"], $currentUser["person"], $currentUser["reason"], $currentUser["short_name"], $currentUser["head"], $currentUser["tel"], $currentUser["email"], $currentUser["password"], $currentUser["docs_name"], $currentUser["post_address"], false, null, null);
    }

    private static function connectToDB() {
        $host = 'joncolab.mysql.ukraine.com.ua';
        $username = 'joncolab_saladin';
        $dbPassword = '2014';
        $db = 'joncolab_trade';
        $connection = new mysqli($host, $username, $dbPassword, $db);

        if ($connection->connect_error) {
            die('Не вдається встановити підключення до бази даних');
        } else {
            $connection->set_charset('utf-8');
            return $connection;
        }
    }

    public static function getUserById($id) {
        $connection = self::connectToDB();
        $sql = 'SELECT * FROM registered WHERE id=\'' . $id . '\'';
        $result = $connection->query($sql);
        $connection->close();
        $currentUser = $result->fetch_assoc();
        return new User($currentUser["id"], $currentUser["status"], $currentUser["full_name"], $currentUser["j-address"], $currentUser["edrpou"], $currentUser["ind"], $currentUser["person"], $currentUser["reason"], $currentUser["short_name"], $currentUser["head"], $currentUser["tel"], $currentUser["email"], $currentUser["password"], $currentUser["docs_name"], $currentUser["post_address"], $currentUser["ver"], $currentUser["trader_id"], $currentUser["applied_for_lots"]);
    }

    public static function getUserByEmail($email) {
        $connection = self::connectToDB();
        $sql = 'SELECT * FROM registered WHERE email=\'' . $email . '\'';
        $result = $connection->query($sql);
        $connection->close();
        $currentUser = $result->fetch_assoc();
        return new User($currentUser["id"], $currentUser["status"], $currentUser["full_name"], $currentUser["j-address"], $currentUser["edrpou"], $currentUser["ind"], $currentUser["person"], $currentUser["reason"], $currentUser["short_name"], $currentUser["head"], $currentUser["tel"], $currentUser["email"], $currentUser["password"], $currentUser["docs_name"], $currentUser["post_address"], $currentUser["ver"], $currentUser["trader_id"], $currentUser["applied_for_lots"]);
    }

    public static function verify($id, $trader_id) {
        $connection = self::connectToDB();
        $sql = 'UPDATE registered SET ver=TRUE, trader_id=\'' . $trader_id . '\' WHERE id=\'' . $id . '\'';
        $connection->query($sql);
        $connection->close();
    }

    public static function count() {
        $connection = self::connectToDB();
        $sql = 'SELECT ver FROM registered';
        $result = $connection->query($sql);
        $connection->close();
        return $result->num_rows;
    }

    public static function countVerified() {
        $connection = self::connectToDB();
        $sql = 'SELECT ver FROM registered WHERE ver=\'1\'';
        $result = $connection->query($sql);
        $connection->close();
        return $result->num_rows;
    }
}