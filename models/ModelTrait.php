<?php
namespace blog\models;
use blog\core\Db;

trait ModelTrait {

    public function insert()
    {
        $db = Db::getConnection();
        $properties = get_object_vars($this);

        $attributes = [];
        $params = [];

        foreach ($properties as $property=>$value) {
            $attributes []= $property;
            $params []= ":{$property}";
        }

        $stmt = $db->prepare('INSERT into '.self::table().' (' . implode(',',$attributes) . ') VALUES(' . implode(',',$params) . ')');
        foreach ($properties as $property=>$value) {
            $stmt->bindValue(":{$property}",$value);
        }
        $stmt->execute();


    }
}