<?php
namespace blog\models;

use blog\core\Db;

class User
{
    public function getUserByUsername($username){
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM user WHERE username =:username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $data =  $stmt->fetch();
        return $data;
    }
    public function registerNewUser($username, $password)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('INSERT INTO user(username,password) VALUES(:username,:password)');
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
    }
}