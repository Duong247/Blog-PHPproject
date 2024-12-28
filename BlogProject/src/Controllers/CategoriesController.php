<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Controller;
use App\Models\Category;
use \PDO;

class CategoriesController extends Controller
{

    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index(){
        $categories = $this->categoryModel->getAllCategory();
        $this->render('manageCategories', ['categories' => $categories]);
    }

    public function create(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $categoryName= $_POST['categoryName'];
            $this->categoryModel->createCategory($categoryName);
        }
        header('Location: /manageCategories');
    }


    public function update(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $categoryId= $_POST['categoryId'];
            $categoryName= $_POST['categoryName'];
            $this->categoryModel->updateCategory($categoryId,$categoryName);
        }
        header('Location: /manageCategories');
    }

    public function delete($categoryId){
        $this->categoryModel->deleteCategory($categoryId);
        header('Location: /manageCategories');
    }

    
}