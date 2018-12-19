<?php

class User
{
    public $username;
    public $password;

    public function register()
    {
        $hash = password_hash($this->password, PASSWORD_DEFAULT);

        $db = Db::getInstance();
        $sql = "INSERT into users(email, password) VALUES (:username, :password)";

        $statement = $db->prepare($sql);
        $statement->bindParam(":username", $this->username);
        $statement->bindParam(":password", $hash);

        return $statement->execute();
    }

    public static function emailExist(string $email)
    {
        $db = Db::getInstance();
        $sql = "SELECT email FROM users WHERE email=:email";

        $statment = $db->prepare($sql);
        $statment->bindParam(':email', $email);

        $statment->execute();
        return $statment->rowCount();
    }

    public static function login(string $email, string $pwd)
    {
        if (self::emailExist($email)) {
            $db = Db::getInstance();
            $sql = "SELECT * FROM users WHERE email=:email";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($pwd, $result['password'])) {
                session_unset();
                $_SESSION['user'] = $result;
                return $result;
            }
        }
        return false;
    }

    public static function isAuth()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function logout()
    {
        session_unset();
        return true;
    }

    public static function getCurrentUser()
    {
        if (self::isAuth()) {
            return $_SESSION['user'];
        }

        return false;
    }

    public static function isCurrentUserAdmin(): bool
    {
        if (self::isAuth() && $_SESSION['user']['type'] === 'admin') {
            return true;
        }

        return false;
    }

    public static function getList(): array
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM users";

        $statement = $db->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function remove($id)
    {
        $db = Db::getInstance();
        $sql = "DELETE FROM users WHERE id = :id";

        $statement = $db->prepare($sql);
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }

}