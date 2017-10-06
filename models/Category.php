<?php
namespace blog\models;
use blog\Db;

class Category
{
    public function getAllCategory()
    {
        $db = new Db();
        $stmt = $db->connect()->prepare('SELECT * FROM category');
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getCategoryByTitle($title)
    {
        $db = new Db();
        $stmt = $db->connect()->prepare('SELECT * FROM category WHERE title=:title');
        $stmt->bindParam(':title',$title);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }
}