<?php
namespace blog\controllers;

use blog\models\Category;

class CategoryController extends BaseController
{
    public function listAllCategories()
    {
        $categories = new Category();
        $categories = $categories->getAllCategory();
        //$_SESSION['categories'] = $categories;

    }
}