<?php
namespace blog\models;

use blog\core\Db;

class Article
{
    public $id;
    public $title;
    public $content;
    public $category_id;
    public $user_id;

    use ModelTrait;

    public function __construct($attributes = [])
    {
        $this->setAttributes($attributes);
    }

    public function getAllArticles()
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM article');
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function articleByUserId($userId)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT a.id,a.title,a.content FROM article a JOIN user u ON a.user_id = u.id WHERE u.id = :userId');
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    public function getArticleById($id)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM article WHERE id = :id');
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }
    public function subs($id = ' IS NULL')
    {
        $db = Db::getConnection();
        if ($id === ' IS NULL'){
            $stmt = $db->prepare('SELECT * FROM category WHERE category_id' . $id);
        } else {
            $stmt = $db->prepare('SELECT * FROM category WHERE category_id = :id');
            $stmt->bindParam(':id', $id);
        }
        $stmt->execute();
        $data = $stmt->fetchAll();
        $result = [];
        foreach ($data as $k=>$v){
            $result []= array(
              "Parent"=>$v['title'],
                "Children"=>$this->subs($v['id'])
            );
        }
        return $result;
    }

    public function userHasArticle($articleId)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT u.username FROM user u JOIN article a ON a.user_id = u.id WHERE a.id = :articleId');
        $stmt->bindValue(':articleId',$articleId);
        $stmt->execute();
        $data = $stmt->fetchColumn();
        return $data;
    }

    public static function table(){
        return 'article';
    }
}