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
$router->addRoute('/\//', [new PostController(), 'index']); // ok
$router->addRoute('/\/home/', [new PostController(), 'getRecentPost']); // ok
$router->addRoute('/\/blogs/', [new PostController(), 'postList']); // ok
$router->addRoute('/\/register\/index/', [new RegisterController(), 'showRegistrationForm']);  // Hiển thị form đăng ký /ok
$router->addRoute('/\/register/', [new RegisterController(), 'register']); // ok


$router->addRoute('/\/login\/index/', [new LoginController(), 'index']); // ok
$router->addRoute('/\/login/', [new LoginController(), 'login']); // ok

$router->addRoute('/\/user\/verify/', [new UserController(), 'verifyEmail']); // ok
$router->addRoute('/\/user\/verifyagain/', [new UserController(), 'sendVerificationEmailAgain']); // ok
$router->addRoute('/\/user\/verify\/index/', [new UserController(), 'verifyEmailForm']); // ok
$router->addRoute('/\/user\/change-pass-email\?token=([^&]+)/', [new UserController(), 'checkTokenChangePass']); // ok
$router->addRoute('/\/user\/reset-password/', [new UserController(), 'resetPassword']); // ok
$router->addRoute('/\/user\/change-pass/', [new UserController(), 'formEmailChangePass']); // ok
$router->addRoute('/\/user\/send-email-token/', [new UserController(), 'sendTokenChangePass']); // ok
$router->addRoute('/\/user\/profile/', [new UserController(), 'profile']); // ok
$router->addRoute('/\/user\/form-update-profile/', [new UserController(), 'formUpdateProfile']); // ok
$router->addRoute('/\/user\/process-update-profile/', [new UserController(), 'updateProfile']); // ok
$router->addRoute('/\/user\/form-change-pass/', [new UserController(), 'formChangePass']); // ok
$router->addRoute('/\/user\/process-change-pass/', [new UserController(), 'changePass']); // ok
$router->addRoute('/\/logout/', [new UserController(), 'logout']); // ok

//post details
$router->addRoute('/\/postDetail\/(\d+)/', [new PostController(), 'show']); // ok
$router->addRoute('/\/postDetail\/(\d+)\/create/', [new CommentController(), 'createComment']); // ok
$router->addRoute('/\/postDetail\/(\d+)\#(\d+)/', [new PostController(), 'show']); // ok
$router->addRoute('/\/deleteComment\?postId=(\d+)\&commentId=(\d+)/', [new CommentController(), 'deleteComment']); // ok
//Blogs
$router->addRoute('/\/blogs\/(\d+)/', [new PostController(), 'getPostByCategory']); // ok
$router->addRoute('/\/userPostList/', [new PostController(), 'getPostByUserId']); // ok

$router->addRoute('/\/createPost/', [new PostController(), 'create']); // ok
$router->addRoute('/\/create/', [new PostController(), 'create']); // ok
$router->addRoute('/\/post\/delete\/(\d+)/', [new PostController(), 'delete']); // ok
$router->addRoute('/\/post\/update\/(\d+)/', [new PostController(), 'showPostInfo']); // ok
$router->addRoute('/\/update\/(\d+)/', [new PostController(), 'update']); // ok


$router->addRoute('/\/blogs\/(\d+)/', [new PostController(), 'getPostByCategory']); // ok
$router->addRoute('/\/userPostList/', [new PostController(), 'getPostByUserId']); // ok
$router->addRoute('/\/blogs\/search-posts/', [new PostController(), 'searchPosts']); //ok

//Admin
$router->addRoute('/\/managePosts/', [new AdminController(), 'managePosts']);  // ok
$router->addRoute('/\/managePosts\/search/', [new AdminController(), 'searchPostsAdmin']); // ok
$router->addRoute('/\/manageUserPosts\/search/', [new AdminController(), 'searchPostsOfUserAdmin']); // ok
$router->addRoute('/\/managePosts\/previewPost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'previewPost']); // ok
$router->addRoute('/\/acceptPost\?postId=(\d+)/', [new AdminController(), 'acceptPost']); // ok
$router->addRoute('/\/declinePost\?postId=(\d+)/', [new AdminController(), 'declinePost']); // ok
$router->addRoute('/\/deletePost\?postId=(\d+)/', [new AdminController(), 'deletePost']); // ok
$router->addRoute('/\/manageUsers/', [new AdminController(), 'getAllUsers']);
$router->addRoute('/\/manageUser\?userId=(\d+)/', [new AdminController(), 'getPostByUserId']);
$router->addRoute('/\/manageUser\/previewPost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'previewPostOfUser']); // ok
$router->addRoute('/\/manageUser\/acceptPost\?postId=(\d+)\&userId=(\d+)/', [new AdminController(), 'acceptPostOfUser']); // ok
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
