<?php

namespace blog\core;

use PDO;
use PDOException;

class Db
{
    private static $host = '192.168.33.10';
    private static $dbname = 'glob-blog';
    private static $username = 'phplay';
    private static $password = 'zx';
    private static $instance;


    public static function connect()
    {
        try {
            $pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset = utf8", self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e){
            echo "Connection failed".$e->getMessage();
        }
    }
    public static function getConnection()
    {
        if(self::$instance == null){
            self::$instance = self::connect();
        }
        return self::$instance;
    }
    /*public static function query($query,$params = array())
    {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        if (explode(' ',$query)[0] == 'SELECT'){
            $data = $statement->fetchAll();
            return $data;
        }
    }*/
}