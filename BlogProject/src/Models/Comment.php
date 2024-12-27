<?php

namespace App\Models;

use ErrorException;
//require_once(__DIR__ . '/../../config.php');

class Comment
{
    private $connection;

    public function __construct()
    {
        // Replace these values with your actual database configuration
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $this->connection = new \mysqli($host, $username, $password, $database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }



    public function getAllCommentsOfPost($postId)
    {
        $postId = $this->connection->real_escape_string($postId);
        $result = $this->connection->query("SELECT * FROM comments inner join users on comments.userId = users.id WHERE postId = $postId AND ISNULL(subcommentId) ORDER BY commentTime;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubCommentsOfMainComment($postId, $commentId): array|bool|null
    {   
        $postId = $this->connection->real_escape_string($postId);
        $commentId = $this->connection->real_escape_string($commentId);
        $result = $this->connection->query("SELECT * FROM comments inner join users on comments.userId = users.id WHERE postId = $postId AND subcommentId = $commentId ORDER BY commentTime;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createComment($content, $postId, $userId, $subCommentId = null) {
        $sql = "INSERT INTO comments (commentContent, postId, userId, subCommentId) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("siii", $content, $postId, $userId, $subCommentId);
    
        if (!$stmt->execute()) {
            throw new ErrorException("Error executing query: " . $stmt->error);
        }
    
        return $this->getNewCommentId();
    }

    public function deleteComment($commentId)
    {
        $commentId = $this->connection->real_escape_string($commentId);
        $this->connection->query("DELETE FROM comments WHERE subCommentId = $commentId");
        $this->connection->query("DELETE FROM comments WHERE commentId = $commentId");
    }

    public function countComment($postId)
    {
        $postId = $this->connection->real_escape_string($postId);
        $result = $this->connection->query("SELECT COUNT(*) FROM comments WHERE postId = $postId");
        return $result->fetch_assoc();
    }

    public function getNewCommentId(){
        $result = $this->connection->query("SELECT LAST_INSERT_ID();");
        return $result->fetch_assoc();
    }
}
