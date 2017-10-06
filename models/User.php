<?php
namespace blog\models;

use blog\Db;

class User
{
    public function getUserByUsername($username){
        $db = new Db();
        $con = $db->connect();
        $stmt = $con->prepare('SELECT * FROM user WHERE username =:username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $data =  $stmt->fetch();
        return $data;
    }
    public function registerNewUser($username, $password)
    {
        $db = new Db();
        $stmt = $db->connect()->prepare('INSERT INTO user(username,password) VALUES(:username,:password)');
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
    }
}