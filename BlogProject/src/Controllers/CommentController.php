<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Controller;

class CommentController extends Controller
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment();
    }

    public function createComment()
    {
        $postId = $_POST['postId'];
        $commentId = $_POST['commentId'] ?? null;
        $content = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');
        $userId = 4; //TODO: Sửa lại userId bằng userId được lấy từ session sau khi có session
        $lastId = $this->commentModel->createComment($content, $postId, $userId, $commentId);
        header('Location: /postDetail/' . $postId . '#cmt' . $lastId['LAST_INSERT_ID()']);
    }

    public function deleteComment(){
        $commentId = $_GET['commentId'];
        $postId = $_GET['postId'];
        $this->commentModel->deleteComment($commentId);
        header('Location: /postDetail/'. $postId . '#comment');
    }
}
