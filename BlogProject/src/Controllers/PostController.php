<?php

namespace App\Controllers;

use App\Models\Post;
use App\Controller;
use App\Models\Category;

class PostController extends Controller
{
    private $postModel;
    private $categoryModel;

    public function __construct()
    {
        $this->postModel = new Post();
        $this->categoryModel = new Category();
    }

    public function index(){
        $posts = $this->postModel->getRecentPosts();
        $categories = $this->categoryModel->getAllCategory();
        $this->render('home', ['posts' => $posts,'categories' => $categories]);
    }

    public function postList()
    {
        // session_start();
        // if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
        //     header('Location: /user/signin');
        // }
        // Fetch all users and display them in a view
        $posts = $this->postModel->getAllPosts();
        
        $this->render('home', ['posts' => $posts]);
    }

    public function getRecentPost(){
        $posts = $this->postModel->getRecentPosts();
        
        $this->render('home', ['posts' => $posts]);

    }

    public function show($postId)
    {

        // session_start();
        // if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
        //     header('Location: /user/signin');
        // }
        // Fetch a single post by ID and display in a view
        $post = $this->postModel->getPostById($postId);
        $postsRecents = $this->postModel->getRecentPosts();
        $categories = $this->categoryModel->getAllCategory();

        $this->render('postDetail', ['post' => $post,'postsRecents' => $postsRecents ,'categories' => $categories]);

    }

    public function create()
    {
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /user/signin');
        }
        // Handle form submission to create a new post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $title = $_POST['title'];
            $content = $_POST['content'];
            
            // Call the model to create a new post
            $this->postModel->createPost($title, $content);
        }

        // Display the form to create a new post
        
        $this->render('posts\post-form', ['post' => []]);

    }

    public function update($postId)
    {

        // Handle form submission to update a post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $title = $_POST['title'];
            $content = $_POST['content'];
            
            // Call the model to update the post
            $this->postModel->updatePost($postId, $title, $content);
        }

        // Fetch the post data and display the form to update
        $post = $this->postModel->getPostById($postId);
        
        $this->render('posts\post-form', ['post' => $post]);
    }

    public function delete($postId)
    {

        // Call the model to delete the post
        $this->postModel->deletePost($postId);

        // Redirect to the index page after deletion
        header('Location: /posts/post-list');
    }
}