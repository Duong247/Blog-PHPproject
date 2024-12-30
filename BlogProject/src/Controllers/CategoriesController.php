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
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /login/index');
        }
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 0){
            header('Location: /accessFailed');
        }
        $categories = $this->categoryModel->getAllCategory();
        $this->render('manageCategories', ['categories' => $categories]);
    }

    public function create(){
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /login/index');
        }
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 0){
            header('Location: /accessFailed');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $categoryName= $_POST['categoryName'];
            $this->categoryModel->createCategory($categoryName);
        }
        header('Location: /manageCategories');
    }


    public function update(){
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /login/index');
        }
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 0){
            header('Location: /accessFailed');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $categoryId= $_POST['categoryId'];
            $categoryName= $_POST['categoryName'];
            $this->categoryModel->updateCategory($categoryId,$categoryName);
        }
        header('Location: /manageCategories');
    }

    public function delete($categoryId){
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /login/index');
        }
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 0){
            header('Location: /accessFailed');
        }
        $this->categoryModel->deleteCategory($categoryId);
        header('Location: /manageCategories');
    }

    
}