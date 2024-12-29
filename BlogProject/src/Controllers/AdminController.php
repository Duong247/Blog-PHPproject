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
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $posts = $this->postModel->getAllManagedPosts();
        $this->render('managePosts', ['posts' => $posts]);
    }


    public function getAllUsers()
    {
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /login/index');
        }
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 0){
            header('Location: /accessFailed');
        }
        $users = $this->userModel->getAllUsers();
        $this->render('manageUsers', ['users' => $users]);
    }

    public function getPostByUserId()
    {
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /login/index');
        }
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 0){
            header('Location: /accessFailed');
        }
        $userId = $_GET['userId'];
        $posts = $this->postModel->getPostByUserId($userId);
        $user = $this->userModel->getUserById($userId);
        $this->render('managePostsOfUser', ['posts' => $posts, 'user' => $user]);
    }

    public function searchPostsAdmin()
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
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
        session_start();
        if(!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null){
            header('Location: /login/index');
        }
        if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 0){
            header('Location: /accessFailed');
        }
        $post = $this->postModel->getPostById($postId);
        $user = $this->userModel->getUserById($userId);
        $postsRecents = $this->postModel->getRecentPosts();
        $categories = $this->categoryModel->getAllCategory();
        $countComments = $this->commentModel->countComment($postId);
        $this->render('previewPost', ['post' => $post, 'user' => $user, 'postsRecents' => $postsRecents, 'categories' => $categories, 'countComment' => $countComments]);
    }
    public function acceptPost($postId)
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $this->postModel->acceptPost($postId);
        header('Location: /managePosts');
    }

    public function declinePost($postId)
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $this->postModel->declinePost($postId);
        header('Location: /managePosts');
    }

    public function deletePost($postId)
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $this->postModel->deletePost($postId);
        header('Location: /managePosts');
    }

    //managePostsOfUser
    public function previewPostOfUser($postId, $userId)
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $post = $this->postModel->getPostById($postId);
        $user = $this->userModel->getUserById($userId);
        $postsRecents = $this->postModel->getRecentPosts();
        $categories = $this->categoryModel->getAllCategory();
        $countComments = $this->commentModel->countComment($postId);
        $this->render('previewPostOfUser', ['post' => $post, 'user' => $user, 'postsRecents' => $postsRecents, 'categories' => $categories, 'countComment' => $countComments]);
    }

    public function searchPostsOfUserAdmin()
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
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
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $this->postModel->acceptPost($postId);
        header('Location: /manageUser?userId=' . $userId);
    }

    public function declinePostOfUser($postId, $userId)
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $this->postModel->declinePost($postId);
        header('Location: /manageUser?userId=' . $userId);
    }

    public function deletePostOfUser($postId, $userId)
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        $this->postModel->deletePost($postId);
        header('Location: /manageUser?userId=' . $userId);
    }

    public function getResultSearchOfUser()
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        if (isset($_POST['searchValue']) && trim($_POST['searchValue']) !== '') {
            $searchValue = $_POST['searchValue'];
            $usersResults = null;
            $usersResults = $this->userModel->searchUser($searchValue);

            return $this->render('manageUsers', ['usersResults' => $usersResults, 'searchvalue' => $searchValue]);
        } else {
            header("Location:/manageUsers");
        }
    }


    public function getResultSearchOfCategories()
    {
        session_start();
        if (!isset($_SESSION['currentUser']) || $_SESSION['currentUser'] === null) {
            header('Location: /login/index');
        }
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 0) {
            header('Location: /accessFailed');
        }
        if (isset($_POST['searchValue']) && trim($_POST['searchValue']) !== '') {
            $searchValue = $_POST['searchValue'];
            $categoriesResults = null;
            $categoriesResults = $this->categoryModel->searchCategories($searchValue);

            return $this->render('manageCategories', ['categoriesResults' => $categoriesResults, 'searchvalue' => $searchValue]);
        } else {
            header("Location:/manageCategories");
        }
    }



}
