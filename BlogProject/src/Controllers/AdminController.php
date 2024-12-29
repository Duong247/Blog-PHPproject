<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Controller;
use App\Models\User;

class AdminController extends Controller
{
    private $postModel;
    private $userModel;
    private $categoryModel;
    private $commentModel;

    public function __construct()
    {
        $this->postModel = new Post();
        $this->userModel = new User();
        $this->categoryModel = new Category();
        $this->commentModel = new Comment();
    }

    public function managePosts()
    {
        $posts = $this->postModel->getAllManagedPosts();
        $this->render('managePosts', ['posts' => $posts]);
    }


    public function getAllUsers()
    {
        $users = $this->userModel->getAllUsers();
        $this->render('manageUsers', ['users' => $users]);
    }

    public function getPostByUserId()
    {
        $userId = $_GET['userId'];
        $posts = $this->postModel->getPostByUserId($userId);
        $user = $this->userModel->getUserById($userId);
        $this->render('managePostsOfUser', ['posts' => $posts, 'user' => $user]);
    }

    public function searchPostsAdmin()
    {
        $searchValue = isset($_GET['searchValue']) && trim($_GET['searchValue']) !== '' ? trim($_GET['searchValue']) : null;
        $status = isset($_GET['status']) && trim($_GET['status']) !== '' ? trim($_GET['status']) : null;

        if ($searchValue === null && $status === null) {
            header('Location: /managePosts');
            exit();
        }

        $posts = $this->postModel->searchPostAdmin($searchValue, $status);

        return $this->render('manageSearchPost', [
            'posts' => $posts,
            'status' => $status,
            'searchValue' => $searchValue
        ]);
    }

    //managePosts
    public function previewPost($postId, $userId)
    {
        $post = $this->postModel->getPostById($postId);
        $user = $this->userModel->getUserById($userId);
        $postsRecents = $this->postModel->getRecentPosts();
        $categories = $this->categoryModel->getAllCategory();
        $countComments = $this->commentModel->countComment($postId);
        $this->render('previewPost', ['post' => $post, 'user' => $user, 'postsRecents' => $postsRecents, 'categories' => $categories, 'countComment' => $countComments]);
    }
    public function acceptPost($postId)
    {
        $this->postModel->acceptPost($postId);
        header('Location: /managePosts');
    }

    public function declinePost($postId)
    {
        $this->postModel->declinePost($postId);
        header('Location: /managePosts');
    }

    public function deletePost($postId)
    {
        $this->postModel->deletePost($postId);
        header('Location: /managePosts');
    }

    //managePostsOfUser
    public function previewPostOfUser($postId, $userId)
    {
        $post = $this->postModel->getPostById($postId);
        $user = $this->userModel->getUserById($userId);
        $postsRecents = $this->postModel->getRecentPosts();
        $categories = $this->categoryModel->getAllCategory();
        $countComments = $this->commentModel->countComment($postId);
        $this->render('previewPostOfUser', ['post' => $post, 'user' => $user, 'postsRecents' => $postsRecents, 'categories' => $categories, 'countComment' => $countComments]);
    }

    public function searchPostsOfUserAdmin()
    {
        $searchValue = isset($_GET['searchValue']) && trim($_GET['searchValue']) !== '' ? trim($_GET['searchValue']) : null;
        $status = isset($_GET['status']) && trim($_GET['status']) !== '' ? trim($_GET['status']) : null;
        $userId = $_GET['userId'];
        if ($searchValue === null && $status === null) {
            header('Location: /manageUser?userId=' . $userId);
            exit();
        }

        $posts = $this->postModel->searchPostsOfUser($userId, $searchValue, $status);
        $user = $this->userModel->getUserById($userId);
        return $this->render('manageSearchPostOfUser', [
            'user' => $user,
            'posts' => $posts,
            'status' => $status,
            'searchValue' => $searchValue
        ]);
    }

    public function acceptPostOfUser($postId, $userId)
    {
        $this->postModel->acceptPost($postId);
        header('Location: /manageUser?userId=' . $userId);
    }

    public function declinePostOfUser($postId, $userId)
    {
        $this->postModel->declinePost($postId);
        header('Location: /manageUser?userId=' . $userId);
    }

    public function deletePostOfUser($postId, $userId)
    {
        $this->postModel->deletePost($postId);
        header('Location: /manageUser?userId=' . $userId);
    }
}
