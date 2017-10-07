<?php
namespace blog\models;

use blog\core\Db;

class Article
{
    public function getAllArticles(){
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
    public function saveNewArticle($title,$content,$category_id,$user_id)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare('INSERT INTO article (title,content,category_id,user_id) VALUES (:title,:content,:category_id,:user_id)');
        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':content',$content);
        $stmt->bindParam(':category_id',$category_id);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();
    }
    public function  updateArticle($id,$title,$content,$category_id,$user_id)
    {
        $db = Db::getConnection();
        $stmt = $db->prepare(
            'UPDATE article
              SET title = :title,
                content = :content,
                category_id = :category_id,
                user_id = :user_id
              WHERE id = :id');
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':title',$title);
        $stmt->bindParam(':content',$content);
        $stmt->bindParam(':category_id',$category_id);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();
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
}