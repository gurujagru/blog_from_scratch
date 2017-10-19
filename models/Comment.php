<?php
namespace blog\models;

use blog\core\Db; 

class Comment
{
	public $id;
	public $content;
	public $user_id;
	public $article_id;
	public $comment_id;

	use ModelTrait;

	public function __construct()
	{
		$this->content = isset($_POST['contentComment'])?$_POST['contentComment']:null;
		$this->user_id = isset($_SESSION['userId'])?$_SESSION['userId']:null;
		$this->comment_id = isset($_POST['commentId'])?$_POST['commentId']:null;
	}
	public function getAllCommentsArticle($articleId, $commentId = ' IS NULL')
	{
		$db = Db::getConnection();
		if($commentId === ' IS NULL'){
			$stmt = $db->prepare("SELECT c.id, c.content, c.created_at, u.username FROM comment c JOIN article a  ON c.article_id = a.id JOIN user u ON u.id = c.user_id WHERE a.id = :articleId AND c.comment_id $commentId ORDER BY c.created_at DESC");
		} else {
			$stmt = $db->prepare("SELECT c.id, c.content, c.created_at, u.username FROM comment c JOIN article a  ON c.article_id = a.id JOIN user u ON u.id = c.user_id WHERE a.id = :articleId AND c.comment_id = :commentId ORDER BY c.created_at DESC");
			$stmt->bindParam(':commentId',$commentId);
		}
		$stmt->bindParam(':articleId',$articleId);	
		$stmt->execute();
		$data = $stmt->fetchAll();
		$result = [];
		foreach ($data as $key => $value) {
			$result []= array(
				"commentId" => $value['id'],
				"created_at" => $value['created_at'],
				"username" => $value['username'],
				"Parent" => $value['content'],
				"Children" => $this->getAllCommentsArticle($articleId, $value['id'])
				);
		}
		return $result;
	}
	public static function table(){
		return 'comment';
	}
}