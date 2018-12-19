<?php

class Db
{
    private static $instance = null;
    private static $params = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$params = include ROOT . '/config/params.php';
            self::$instance = new PDO(
                "mysql:host=" . self::$params['db_host'] . ";dbname=" . self::$params['db_name'],
                self::$params['db_user'],
                self::$params['db_pass'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
        }

        return self::$instance;
    }
}