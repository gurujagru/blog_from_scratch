<?php

namespace blog\controllers;

use blog\models\Article;
use blog\models\Category;
use blog\models\Comment;
use blog\core\Post;
use blog\core\Session;

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
        $comment = new Comment();
        if(isset($_REQUEST['sacuvaj-komentar'])) {

            //TODO provera $_POST['Coment']['attr']

            Session::userLogged();
            $comment->user_id = Session::getSession('userId');
            $comment->article_id = $id;
            $comment->content = Post::post('comment','contentComment');
            $commentByArticle = $comment->getAllCommentsArticle($id,Post::post('comment','commentId'));
            $comment->comment_id = Post::post('comment','commentId');
            $comment->save();
            header('location:/article/view/' . $id);
            exit();
        }
        $article = new Article();
        $singleArticle = $article->getArticleById($id);
        if($singleArticle == false){
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
        $article = new Article();
        $category = new Category();
        if(isset($_REQUEST['create-article'])){
            Session::userLogged();
            $article->user_id = Session::getSession('userId');
            $categiryTitle = explode('/', Post::post('article','category'));
            $categiryTitle = $categiryTitle[max(array_keys($categiryTitle))];
            $category = $category->getCategoryByTitle($categiryTitle);
            $article->category_id = $category['id'];
            $article->content = Post::post('article','content');
            $article->title = Post::post('article','title');
            $article->save();
            //echo '<script>alert("Uspesno ste kreirali clanak!")</script>';
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
        $article = new Article();
        $category = new Category();
        if(isset($_REQUEST['edit-article'])){
            Session::userLogged();
            $article->user_id = Session::getSession('userId');
            $categiryTitle = explode('/', $_POST['category']);
            $categiryTitle = $categiryTitle[max(array_keys($categiryTitle))];
            $category = $category->getCategoryByTitle($categiryTitle);
            $article->category_id = $category['id'];
            $article->id = $id;
            $article->content = Post::post('article','content');
            $article->title = Post::post('article','title');
            $article->save();
            //echo '<script>alert("Uspesno ste izmenili clanak!")</script>';
            header('Location:/article/my-articles');
            die();
        }
        if($_SESSION['username'] == $article->userHasArticle($id)) {
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
            //echo '<script>alert("Uspesno ste izmenili clanak!")</script>';
            header('Location:/article/my-articles');
        die();
    }
    public function saveComment($id)
    {
        $comment = new Comment();
        $comment->save();
        die();
    }
    public function deleteComment($id)
    {
        $comment = new Comment();
        $comment->delete(['id'=>$id]);
        die();
    }

}