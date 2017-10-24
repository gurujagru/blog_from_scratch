<?php
namespace blog\core;

class Session
{
    private static $messages = [
        'login'=>'Morate biti ulogovani!',
    ];

    public static function getMesages()
    {
        return self::$messages;
    }
    public static function getSession($index)
    {
       return isset($_SESSION[$index]) ? $_SESSION[$index] : null;
    }

    public static function setSession($index,$value)
    {
        return $_SESSION[$index] = $value;
    }

    public static function userLogged()
    {
        if(self::getSession('userId') == null){
            self::setFlashMessage('login');
            header('Location:/login');
        }
    }

    public static function getFlashMessage()
    {
        $sessionMessage = self::getSession('flashMessage');
        echo $sessionMessage;
        unset ($_SESSION['flashMessage']);
    }

    public static function setFlashMessage($name)
    {
        $messages = self::getMesages();
        foreach ($messages as $k=>$v){
            if ($name == $k){
                $_SESSION['flashMessage'] = $v;
                return $_SESSION['flashMessage'];
            }
        }
        return false;
    }
}