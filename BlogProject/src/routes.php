<?php

use App\Controllers\AdminController;
use App\Controllers\AuthenticationController;
use App\Controllers\CategoriesController;
use App\Controllers\CommentController;
use App\Controllers\PostController;
use App\Controllers\RegisterController;
use App\Router;
use App\Controllers\UserController;
use App\Controllers\LoginController;


// Usage:
$router = new Router();
// ITC route

//Home
$router->addRoute('/\//', [new PostController(), 'index']);
$router->addRoute('/\/home/', [new PostController(), 'getRecentPost']);
$router->addRoute('/\/blogs/', [new PostController(), 'postList']);
$router->addRoute('/\/register\/index/', [new RegisterController(), 'showRegistrationForm']);  // Hiển thị form đăng ký
$router->addRoute('/\/register/', [new RegisterController(), 'register']);


$router->addRoute('/\/login\/index/', [new LoginController(), 'index']);
$router->addRoute('/\/login/', [new LoginController(), 'login']);

$router->addRoute('/\/user\/verify/', [new UserController(), 'verifyEmail']);
$router->addRoute('/\/user\/verifyagain/', [new UserController(), 'sendVerificationEmailAgain']);
$router->addRoute('/\/user\/verify\/index/', [new UserController(), 'verifyEmailForm']);
$router->addRoute('/\/user\/change-pass-email\?token=([^&]+)/', [new UserController(), 'checkTokenChangePass']);
$router->addRoute('/\/user\/reset-password/', [new UserController(), 'resetPassword']);
$router->addRoute('/\/user\/change-pass/', [new UserController(), 'formEmailChangePass']);
$router->addRoute('/\/user\/send-email-token/', [new UserController(), 'sendTokenChangePass']);
$router->addRoute('/\/user\/profile/', [new UserController(), 'profile']);
$router->addRoute('/\/user\/form-update-profile/', [new UserController(), 'formUpdateProfile']);
$router->addRoute('/\/user\/process-update-profile/', [new UserController(), 'updateProfile']);
$router->addRoute('/\/user\/form-change-pass/', [new UserController(), 'formChangePass']);
$router->addRoute('/\/user\/process-change-pass/', [new UserController(), 'changePass']);
$router->addRoute('/\/logout/', [new UserController(), 'logout']);

//post details
$router->addRoute('/\/postDetail\/(\d+)/', [new PostController(), 'show']);
$router->addRoute('/\/postDetail\/(\d+)\/create/', [new CommentController(), 'createComment']);
$router->addRoute('/\/postDetail\/(\d+)\#(\d+)/', [new PostController(), 'show']);
$router->addRoute('/\/deleteComment\?postId=(\d+)\&commentId=(\d+)/', [new CommentController(), 'deleteComment']);
//Blogs
$router->addRoute('/\/blogs\/(\d+)/', [new PostController(), 'getPostByCategory']);
$router->addRoute('/\/userPostList/', [new PostController(), 'getPostByUserId']);

$router->addRoute('/\/createPost/', [new PostController(), 'showCreatePost']);
$router->addRoute('/\/create/', [new PostController(), 'create']);
$router->addRoute('/\/post\/delete\/(\d+)/', [new PostController(), 'delete']);
$router->addRoute('/\/post\/update\/(\d+)/', [new PostController(), 'showPostInfo']);
$router->addRoute('/\/update\/(\d+)/', [new PostController(), 'update']);
$router->addRoute('/\/post\/search/', [new PostController(), 'getSearchResult']);


$router->addRoute('/\/blogs\/(\d+)/', [new PostController(), 'getPostByCategory']);
$router->addRoute('/\/userPostList/', [new PostController(), 'getPostByUserId']);
$router->addRoute('/\/blogs\/search-posts/', [new PostController(), 'searchPosts']);

//Admin
$router->addRoute('/\/managePosts/', [new AdminController(), 'managePosts']);
$router->addRoute('/\/managePosts\/search/', [new AdminController(), 'searchPostsAdmin']);
$router->addRoute('/\/manageUserPosts\/search/', [new AdminController(), 'searchPostsOfUserAdmin']);
$router->addRoute('/\/managePosts\/previewPost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'previewPost']);
$router->addRoute('/\/acceptPost\?postId=(\d+)/', [new AdminController(), 'acceptPost']);
$router->addRoute('/\/declinePost\?postId=(\d+)/', [new AdminController(), 'declinePost']);
$router->addRoute('/\/deletePost\?postId=(\d+)/', [new AdminController(), 'deletePost']);
$router->addRoute('/\/manageUsers/', [new AdminController(), 'getAllUsers']);
$router->addRoute('/\/manageUser\?userId=(\d+)/', [new AdminController(), 'getPostByUserId']);
$router->addRoute('/\/manageUser\/previewPost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'previewPostOfUser']);
$router->addRoute('/\/manageUser\/acceptPost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'acceptPostOfUser']);
$router->addRoute('/\/manageUser\/declinePost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'declinePostOfUser']);
$router->addRoute('/\/manageUser\/deletePost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'deletePostOfUser']);
$router->addRoute('/\/manageUser\/search/', [new AdminController(), 'getResultSearchOfUser']);
$router->addRoute('/\/manageCategories\/search/', [new AdminController(), 'getResultSearchOfCategories']);


// categories
$router->addRoute('/\/manageCategories/', [new CategoriesController(), 'index']);
$router->addRoute('/\/manageCategories\/create/', [new CategoriesController(), 'create']);
$router->addRoute('/\/manageCategories\/delete\/(\d+)/', [new CategoriesController(), 'delete']);
$router->addRoute('/\/manageCategories\/update\/(\d+)/', [new CategoriesController(), 'update']);
$router->addRoute('/\/manageCategories\/search/', [new AdminController(), 'getResultSearchOfCategories']);


// access failed
$router->addRoute('/\/accessFailed/', [new UserController(), 'accessFailed']);

