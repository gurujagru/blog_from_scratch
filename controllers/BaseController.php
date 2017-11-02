<?php
namespace blog\controllers;

abstract class BaseController{
    private $podaci = [];
    final function setData($name,$value)
    {
        if (preg_match('/^[a-zA-Z]+[a-z_]*$/',$name)){
            $this->podaci[$name] = $value;
        }
    }
    final function getData()
    {
        return $this->podaci;
    }
    public static function renderView($view){
        require_once('./views/'.$view.'.php');
    }

}