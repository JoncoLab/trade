<?php

class User
{
    var $id;
    var $name;
    var $number;
    var $email;
    var $password;
    var $address;
    var $verified = false;

    private function User($id, $email, $password, $name, $number, $address) {
        $this->id = $id;
        $this->name = $name;
        $this->number = $number;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
    }

    public static function registerUser($email, $password, $name, $number, $address) {
        $host = '127.0.0.1';
        $username = 'Saladin';
        $userPassword = '0sDD0pOWnLoGCUgD';
        $db = 'users';
        $connection = new mysqli($host, $username, $userPassword, $db);

        if ($connection->connect_error) {
            die('Не вдається встановити підключення до бази даних:\r\n' . $connection->connect_error);
        } else {
            $sql = 'INSERT INTO registered (name, email, password, number, address) VALUES (\'' . $name. '\', \'' . $email . '\', \'' . $password . '\', \'' . $number . '\', \'' . $address . '\')';
            $connection->query($sql);
            $sql = 'SELECT * FROM registered WHERE email=\'' . $email . '\'';
            $result = $connection->query($sql);
            $currentUser = $result->fetch_assoc();
            $connection->close();
            return new User($currentUser["id"], $currentUser["email"], $currentUser["password"], $currentUser["name"], $currentUser["number"], $currentUser["address"]);
        }
    }

    public static function getUserById($id) {
        $host = '127.0.0.1';
        $username = 'Saladin';
        $userPassword = '0sDD0pOWnLoGCUgD';
        $db = 'users';
        $connection = new mysqli($host, $username, $userPassword, $db);

        if ($connection->connect_error) {
            die('Не вдається встановити підключення до бази даних:\r\n' . $connection->connect_error);
        } else {
            $sql = 'SELECT * FROM registered WHERE id=\'' . $id . '\'';
            $result = $connection->query($sql);
            $currentUser = $result->fetch_assoc();
            $connection->close();
            return new User($currentUser["id"], $currentUser["email"], $currentUser["password"], $currentUser["name"], $currentUser["number"], $currentUser["address"]);
        }
    }

    public static function getUserByEmail($email) {
        $host = '127.0.0.1';
        $username = 'Saladin';
        $userPassword = '0sDD0pOWnLoGCUgD';
        $db = 'users';
        $connection = new mysqli($host, $username, $userPassword, $db);

        if ($connection->connect_error) {
            die('Не вдається встановити підключення до бази даних:\r\n' . $connection->connect_error);
        } else {
            $sql = 'SELECT * FROM registered WHERE email=\'' . $email . '\'';
            $result = $connection->query($sql);
            $currentUser = $result->fetch_assoc();
            $connection->close();
            return new User($currentUser["id"], $currentUser["email"], $currentUser["password"], $currentUser["name"], $currentUser["number"], $currentUser["address"]);
        }
    }
}