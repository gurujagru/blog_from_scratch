<?php
namespace blog\controllers;

use blog\core\exceptions\CustomException;
use blog\models\Article;
use blog\models\Category;
use blog\models\Comment;
use blog\core\Session;
use Exception;

class ArticleController extends BaseController
{
    public function index()
    {
        $article = new Article();
        $articles  = $article->getAllArticles();
        $this->setData('articles',$articles);

    }
    public function view($id)
    {
        if (isset($_REQUEST['sacuvaj-komentar'])) {
            $comment = new Comment($_POST['comment']);
            $commentId = $comment->getCommentByArticle($id);
            if (!empty($commentId) && isset($_POST['comment']['comment_id'])){
                try {
                    foreach ($commentId as $key => $value) {
                        if ($_POST['comment']['comment_id'] == $value['id']){
                            $valueExists = $value['id'];
                        }
                    }
                    if (!isset($valueExists)){
                        throw new CustomException('Pogrešan unos! Pokušajte ponovo!');
                    }
                } catch(Exception $e) {
                    echo $e->getMessage();
                    exit;
                }
            }
            Session::userLogged();
            $comment->user_id = Session::getSession('userId');
            $comment->article_id = $id;
            $comment->save();
            header('location:/article/view/' . $id);
            exit();
        }
        $article = new Article();
        $singleArticle = $article->getArticleById($id);
        if ($singleArticle == false){
            die('404 not found');
        }
        $userHasArticle = $article->userHasArticle($id);
        $this->setData('userHasArticle',$userHasArticle);
        $this->setData('singleArticle',$singleArticle);

        $comment = new Comment();
        $comment = $comment->getAllCommentsArticle($id);
        $this->setData('comments',$comment);
    }
    public function myArticles()
    {
        $article = new Article();
        $articles = $article->articleByUserId($_SESSION['userId']);
        $this->setData('myArticles',$articles);
        return $articles;

    }
    public function create(){
        if (isset($_REQUEST['create-article'])){
            $article = new Article($_POST['article']);
            $category = new Category();
            Session::userLogged();
            $article->user_id = Session::getSession('userId');
            $categiryTitle = explode('/', $_POST['category']);
            $categiryTitle = $categiryTitle[max(array_keys($categiryTitle))];
            $category = $category->getCategoryByTitle($categiryTitle);
            $article->category_id = $category['id'];
            $article->save();
            header('Location:/article/my-articles');
            die();
        } else {
            $newArticle = new Article();
            $newArticle = $newArticle->subs();
            $this->setData('potkategorije',$newArticle);
        }
    }
    public function edit($id)
    {
        if (isset($_REQUEST['edit-article'])){
            $article = new Article($_POST['article']);
            $category = new Category();
            Session::userLogged();
            $article->user_id = Session::getSession('userId');
            $categiryTitle = explode('/', $_POST['category']);
            $categiryTitle = $categiryTitle[max(array_keys($categiryTitle))];
            $category = $category->getCategoryByTitle($categiryTitle);
            $article->category_id = $category['id'];
            $article->id = $id;
            $article->save();
            header('Location:/article/my-articles');
            die();
        }
        $article = new Article();
        if ($_SESSION['username'] == $article->userHasArticle($id)) {
            $articleEdit = $article->getArticleById($id);
            $this->setData('articleEdit', $articleEdit);

            $newArticle = new Article();
            $newArticle = $newArticle->subs();
            $this->setData('potkategorije',$newArticle);
        } else {
            $_SESSION['errorUpdate'] = 'Ne moze to tako!';
            header ('Location:/');
            die();
        }
    }
    public function delete($id)
    {
        $article = new Article();
        $article->delete(['id'=>$id]);
        header('Location:/article/my-articles');
        die();
    }
    public function deleteComment($id)
    {
        $comment = new Comment();
        $comment->delete(['id'=>$id]);
        die();
    }
}