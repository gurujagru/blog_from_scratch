<?php

namespace blog\controllers;

use blog\models\User;
use blog\core\Session;

class UserController extends BaseController
{
    public static function login()
    {
        if (isset($_REQUEST['login']) || isset($_REQUEST['signup'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            $user = new User();
            $user = $user->getUserByUsername($username);
            if (!empty($user) && $password == $user['password']) {
                Session::setSession('username',$username);
                Session::setSession('userId',$user['id']);
                header('Location:/');
            }
        }
    }
    public static function logout()
    {
        if (isset($_SESSION['userId'])){
            session_destroy();
        } else {
            Session::setFlashMessage('login');
        }
        header('Location:/');
        exit;
    }
    public static function signup(){
        if(isset($_POST['signup'])) {
            $username = $_POST['username'];
            //$password = md5($_POST['password']);
            $user = new User();
            $user->getUserByUsername($username);
            if ($user->getUserByUsername($username)) {
                echo "Korisnicko ime vec postoji";
            } else {
                $user->save();
                self::login();
            }
        }
    }
}