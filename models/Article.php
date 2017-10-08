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

    public function __construct()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->title = $_POST['title'];
            $this->content = $_POST['content'];
            $this->user_id = $_SESSION['userId'];
        }
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

    public function deleteArticle($id)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('DELETE FROM article WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function subs($id)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('SELECT * FROM subcategories WHERE category_id = :id');
        $stmt->bindParam(':id', $id);
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
    public static function table(){
        return 'article';
    }
}