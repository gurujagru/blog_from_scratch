<?php
namespace blog\models;

use blog\core\Db;

class Category
{
    public function getAllCategory()
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM category');
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getCategoryByTitle($title)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM category WHERE title=:title');
        $stmt->bindParam(':title',$title);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }
}