<?php

namespace App\Controllers;

use App\Models\Post;
use App\Controller;

class AdminController extends Controller
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function managePosts(){
        $posts = $this->postModel->getAllManagedPosts();
        $this->render('managePosts', ['posts' => $posts]);
    }

    public function acceptPost($postId){
        $this->postModel->acceptPost($postId);
        header('Location: /managePosts');
    }

    public function declinePost($postId){
        $this->postModel->declinePost($postId);
        header('Location: /managePosts');
    }

    public function deletePost($postId){
        $this->postModel->deletePost($postId);
        header('Location: /managePosts');
    }
}