<?php

namespace blog\controllers;

use blog\models\Article;
use blog\models\Category;

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
        $article = new Article();
        $singleArticle = $article->getArticleById($id);
        if($singleArticle == false){
            die('404 not found');
        }
        $this->setData('singleArticle',$singleArticle);
    }
    public function myArticles()
    {
        $article = new Article();
        $articles = $article->articleByUserId($_SESSION['userId']);
        $this->setData('myArticles',$articles);

    }
    public function create(){
        $article = new Article();
        $category = new Category();
        if(isset($_REQUEST['create-article'])){
            $category = $category->getCategoryByTitle($_POST['category']);
            $article->category_id = $category['id'];
            $article->save();
            //echo '<script>alert("Uspesno ste kreirali clanak!")</script>';
            header('Location:/article/my-articles');
            die();
        } else {
            $categories = $category->getAllCategory();
            $this->setData('categories',$categories);

            $newArticle = new Article();
            $newArticle = $newArticle->subs(18);
            $this->setData('potkategorije',$newArticle);
        }
    }
    public function edit($id)
    {
        $article = new Article();
        $category = new Category();
        if(isset($_REQUEST['edit-article'])){
            $category = $category->getCategoryByTitle($_POST['category']);
            $article->category_id = $category['id'];
            $article->id = $id;
            $article->update();
            //echo '<script>alert("Uspesno ste izmenili clanak!")</script>';
            header('Location:/article/my-articles');
            die();
        }
        $articleEdit = $article->getArticleById($id);
        $categories = $category->getAllCategory();
        $this->setData('categories',$categories);
        $this->setData('articleEdit',$articleEdit);

        $newArticle = new Article();
        $newArticle = $newArticle->subs(18);
        $this->setData('potkategorije',$newArticle);
    }
    public function delete($id)
    {
        $article = new Article();
        $article->deleteArticle($id);
            //echo '<script>alert("Uspesno ste izmenili clanak!")</script>';
            header('Location:/article/my-articles');
            die();
    }

}