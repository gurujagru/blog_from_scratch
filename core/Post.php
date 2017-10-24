<?php
namespace blog\core;

class Post
{
    public static function isPost()
    {
        return $_POST ? true : false;
    }

    public static function post($modelName, $attr)
    {
        $post = [];
        if (self::isPost()) {
            foreach ($_POST as $key => $value) {
                if ($key == $attr) {
                    $post[$modelName][$key] = $value;
                    return $value;
                }
            }
        }
        return null;
    }
}