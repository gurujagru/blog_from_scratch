<?php
namespace blog\models;

use blog\core\Db;

class User
{
    private $username;
    private $password;

    use ModelTrait;

    public function __construct()
    {
        $this->username = $_POST['username'];
        $this->password = md5($_POST['password']);
    }

    public function getUserByUsername($username){
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM user WHERE username =:username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $data =  $stmt->fetch();
        return $data;
    }

    public static function table()
    {
        return 'user';
    }
}