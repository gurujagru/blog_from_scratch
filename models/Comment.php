<?php
namespace blog\models;

use blog\core\Db; 

class Comment
{
	private $id;
	private $conntent;
	private $user_id;
	private $article_id;
	private $comment_id;

	public function getAllCommentsArticle($articleId, $commentId = ' IS NULL')
	{
		$db = Db::getConnection();
		if($commentId === ' IS NULL'){
			$stmt = $db->prepare("SELECT c.id, c.content, c.created_at, c.comment_id, u.username FROM comment c JOIN article a  ON c.article_id = a.id JOIN user u ON u.id = c.user_id WHERE a.id = :articleId AND c.comment_id $commentId ORDER BY c.created_at DESC");
		} else {
			$stmt = $db->prepare("SELECT c.id, c.content, c.created_at, c.comment_id, u.username FROM comment c JOIN article a  ON c.article_id = a.id JOIN user u ON u.id = c.user_id WHERE a.id = :articleId AND c.comment_id = :commentId ORDER BY c.created_at DESC");
			$stmt->bindParam(':commentId',$commentId);
		}
		$stmt->bindParam(':articleId',$articleId);	
		$stmt->execute();
		$data = $stmt->fetchAll();
		$result = [];
		foreach ($data as $key => $value) {
			$result []= array(
				"comment_id" => $value['comment_id'],
				"created_at" => $value['created_at'],
				"username" => $value['username'],
				"Parent" => $value['content'],
				"Children" => $this->getAllCommentsArticle($articleId, $value['id'])
				);
		}
		return $result;
	}
}