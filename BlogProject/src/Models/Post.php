<?php

namespace App\Models;
//require_once(__DIR__ . '/../../config.php');

class Post
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

    public function getAllPosts()
    {
        $result = $this->connection->query("SELECT  posts.postId, posts.postName,posts.description, categories.categoryId, categories.categoryName, posts.photo, posts.content, posts.uploadTime, users.first_name, users.last_name, COUNT(comments.commentId) AS commentCount
                                                        FROM blog_schema.posts 
                                                            INNER JOIN blog_schema.users ON posts.userId = users.id
                                                            INNER JOIN blog_schema.categories ON categories.categoryId = posts.categoryId
                                                            LEFT JOIN blog_schema.comments ON comments.postId = posts.postId
                                                        WHERE posts.status = 1
                                                        GROUP BY 
                                                            posts.postId,
                                                            posts.postName,
                                                            posts.description,
                                                            categories.categoryName,
                                                            posts.photo,
                                                            posts.content,
                                                            posts.uploadTime,
                                                            users.first_name,
                                                            users.last_name,
                                                            categories.categoryId
                                                        ORDER BY posts.uploadTime DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getRecentPosts()
    {
        $result = $this->connection->query(" SELECT  posts.postId, posts.postName,posts.description, categories.categoryId, categories.categoryName, posts.photo, posts.content, posts.uploadTime, users.first_name, users.last_name, COUNT(comments.commentId) AS commentCount
                                                        FROM blog_schema.posts 
                                                            INNER JOIN blog_schema.users ON posts.userId = users.id
                                                            INNER JOIN blog_schema.categories ON categories.categoryId = posts.categoryId
                                                            LEFT JOIN blog_schema.comments ON comments.postId = posts.postId
                                                        WHERE posts.status = 1
                                                        GROUP BY 
                                                            posts.postId,
                                                            posts.postName,
                                                            posts.description,
                                                            categories.categoryName,
                                                            posts.photo,
                                                            posts.content,
                                                            posts.uploadTime,
                                                            users.first_name,
                                                            users.last_name,
                                                            categories.categoryId
                                                        ORDER BY posts.uploadTime DESC
                                                        LIMIT 3

                                                    ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostByUserId($userId): array|bool|null
    {
        $userId = $this->connection->real_escape_string($userId);
        $result = $this->connection->query(" SELECT * FROM blog_schema.posts join blog_schema.categories on posts.categoryId = categories.categoryId where userId = $userId");

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getPostsByCategory($categoryId): array|bool|null
    {
        $categoryId = $this->connection->real_escape_string($categoryId);
        $result = $this->connection->query(" SELECT  posts.postId, posts.postName,posts.description, categories.categoryId, categories.categoryName, posts.photo, posts.content, posts.uploadTime, users.first_name, users.last_name, COUNT(comments.commentId) AS commentCount
                                                        FROM blog_schema.posts 
                                                            INNER JOIN blog_schema.users ON posts.userId = users.id
                                                            INNER JOIN blog_schema.categories ON categories.categoryId = posts.categoryId
                                                            LEFT JOIN blog_schema.comments ON comments.postId = posts.postId
                                                        WHERE posts.status = 1 and categories.categoryId = $categoryId
                                                        GROUP BY 
                                                            posts.postId,
                                                            posts.postName,
                                                            posts.description,
                                                            categories.categoryName,
                                                            posts.photo,
                                                            posts.content,
                                                            posts.uploadTime,
                                                            users.first_name,
                                                            users.last_name,
                                                            categories.categoryId
                                                        ORDER BY posts.uploadTime DESC
                                                    ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getSearchResultByPostName($postNameSearch): array|bool|null
    {
        $userId=$_SESSION['currentUser'];
        $postNameSearch = $this->connection->real_escape_string($postNameSearch);
        $result = $this->connection->query(" SELECT posts.postId, posts.postName,posts.description, categories.categoryName, posts.photo, posts.uploadTime,status, userId
                                                    FROM blog_schema.posts  join  blog_schema.categories on posts.categoryId = categories.categoryId 
                                                    WHERE postName LIKE '%$postNameSearch%' AND userId= $userId ORDER BY uploadTime DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSearchResultByStatus($statusSearchValue): array|bool|null
    {
        $userId=$_SESSION['currentUser'];
        $statusSearchValue = $this->connection->real_escape_string($statusSearchValue);
        $result = $this->connection->query(" SELECT posts.postId, posts.postName,posts.description, categories.categoryName, posts.photo, posts.uploadTime,status, userId
                                                    FROM blog_schema.posts  join  blog_schema.categories on posts.categoryId = categories.categoryId 
                                                    WHERE status = $statusSearchValue AND userId= $userId ORDER BY uploadTime DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSearchResultByBoth($postNameSearch,$statusSearchValue): array|bool|null
    {
        $userId=$_SESSION['currentUser'];
        $postNameSearch = $this->connection->real_escape_string($postNameSearch);
        $statusSearchValue = $this->connection->real_escape_string($statusSearchValue);
        $result = $this->connection->query(" SELECT  posts.postId, posts.postName,posts.description, categories.categoryName, posts.photo, posts.uploadTime,status, userId
                                                    FROM blog_schema.posts 
                                                        INNER JOIN blog_schema.users ON posts.userId = users.id
                                                        INNER JOIN blog_schema.categories ON categories.categoryId = posts.categoryId
                                                    WHERE posts.status = '$statusSearchValue' AND postName LIKE '%$postNameSearch%' AND userId= $userId 
                                                    ORDER BY posts.uploadTime DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }



    public function getPostById($postId): array|bool|null
    {
        $postId = $this->connection->real_escape_string($postId);
        $result = $this->connection->query(" SELECT postId,postName,description,categories.categoryId, posts.photo, content, uploadTime, first_name, last_name ,categoryName, userId
                                                    FROM blog_schema.posts 
                                                        Inner join blog_schema.users on posts.userId = users.id
                                                        inner join blog_schema.categories on categories.categoryId = posts.categoryId
                                                    Where postId = $postId");
        return $result->fetch_assoc();
    }

    public function createPost($postName, $description, $categoryId, $photo, $content, $userId)
    {
        $postName = $this->connection->real_escape_string($postName);
        $description = $this->connection->real_escape_string($description);
        $categoryId = $this->connection->real_escape_string($categoryId);
        $photo = $this->connection->real_escape_string($photo);
        $content = $this->connection->real_escape_string($content);
        $userId = $this->connection->real_escape_string($userId);
        

        $this->connection->query("INSERT INTO posts
                                        (`postName`, `description`, `categoryId`, `photo`, `content`,  `userId` ) 
                                        VALUES ('$postName','$description','$categoryId','$photo','$content','$userId')");

        // Redirect to the index page after creating post
        // header('Location: /');
    }

    public function updatePost($postId, $postName, $description, $categoryId, $photo, $content)
    {
        $postId = $this->connection->real_escape_string($postId);
        $postName = $this->connection->real_escape_string($postName);
        $description = $this->connection->real_escape_string($description);
        $categoryId = $this->connection->real_escape_string($categoryId);
        $photo = $this->connection->real_escape_string($photo);
        $content = $this->connection->real_escape_string($content);


        $this->connection->query("UPDATE posts
                                        SET postName = '$postName' ,description = '$description',categoryId = '$categoryId',photo='$photo',content='$content',uploadTime=Now()
                                        WHERE postId = $postId");

        // Redirect to the index page after update
        // header('Location: /userPostList');
    }

    public function deletePost($postId)
    {
        $postId = $this->connection->real_escape_string($postId);
        $this->connection->query("DELETE FROM comments WHERE postId = $postId");
        $this->connection->query("DELETE FROM posts WHERE postId = $postId");
    }

    public function getAllManagedPosts()
    {
        $result = $this->connection->query("SELECT  posts.postId, posts.postName,posts.description, categories.categoryName, posts.photo, posts.content, posts.uploadTime,  users.first_name, users.last_name, posts.status, users.id
                                                        FROM blog_schema.posts 
                                                            INNER JOIN blog_schema.users ON posts.userId = users.id
                                                            INNER JOIN blog_schema.categories ON categories.categoryId = posts.categoryId
                                                            LEFT JOIN blog_schema.comments ON comments.postId = posts.postId
                                                        GROUP BY 
                                                            posts.postId,
                                                            posts.postName,
                                                            posts.description,
                                                            categories.categoryName,
                                                            posts.photo,
                                                            posts.content,
                                                            posts.uploadTime,
                                                            users.first_name,
                                                            users.last_name");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchPosts($searchTerm)
    {
        // Escaping input để tránh SQL Injection
        $searchTerm = $this->connection->real_escape_string($searchTerm);

        // Truy vấn tìm kiếm
        $query = "SELECT  posts.postId, posts.postName,posts.description, categories.categoryId, categories.categoryName, posts.photo, posts.content, posts.uploadTime, users.first_name, users.last_name, COUNT(comments.commentId) AS commentCount
                                                        FROM blog_schema.posts 
                                                            INNER JOIN blog_schema.users ON posts.userId = users.id
                                                            INNER JOIN blog_schema.categories ON categories.categoryId = posts.categoryId
                                                            LEFT JOIN blog_schema.comments ON comments.postId = posts.postId
                                                        WHERE posts.status = 1 and posts.postName LIKE '%$searchTerm%'
                                                        GROUP BY 
                                                            posts.postId,
                                                            posts.postName,
                                                            posts.description,
                                                            categories.categoryName,
                                                            posts.photo,
                                                            posts.content,
                                                            posts.uploadTime,
                                                            users.first_name,
                                                            users.last_name,
                                                            categories.categoryId
                                                        ORDER BY posts.uploadTime DESC";

        // Thực hiện truy vấn
        $result = $this->connection->query($query);

        // Kiểm tra kết quả
        if ($result->num_rows > 0) {
            // Lưu các bài viết tìm được
            $posts = [];
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
            return $posts; // Trả về danh sách bài viết
        } else {
            return []; // Không tìm thấy bài viết
        }
    }

    public function searchPostAdmin($namePost, $status)
    {
        $searchTerm =
            $namePost !== null ? $this->connection->real_escape_string($namePost) : '';
        $status =
            $status !== null ? $this->connection->real_escape_string($status) : '';

        $conditions = [];

        if ($searchTerm !== '') {
            $conditions[] = "posts.postName LIKE '%$searchTerm%'";
        }

        if ($status !== '') {
            $conditions[] = "posts.status = $status";
        }

        $query = "SELECT posts.postId, posts.postName, posts.description, categories.categoryName, posts.photo, posts.content, posts.uploadTime, users.first_name, users.last_name, posts.status, users.id
              FROM blog_schema.posts 
              INNER JOIN blog_schema.users ON posts.userId = users.id
              INNER JOIN blog_schema.categories ON categories.categoryId = posts.categoryId
              LEFT JOIN blog_schema.comments ON comments.postId = posts.postId";

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " GROUP BY posts.postId, posts.postName, posts.description, categories.categoryName, posts.photo, posts.content, posts.uploadTime, users.first_name, users.last_name";

        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            $posts = [];
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
            return $posts;
        } else {
            return [];
        }
    }
    public function searchPostsOfUser($userId, $searchValue, $status)
    {
        $userId = $this->connection->real_escape_string($userId);
        $searchValue =
            $searchValue !== null ? $this->connection->real_escape_string($searchValue) : '';
        $status =
            $status !== null ? $this->connection->real_escape_string($status) : '';

        $conditions = [];

        if ($searchValue !== '') {
            $conditions[] = "posts.postName LIKE '%$searchValue%'";
        }

        if ($status !== '') {
            $conditions[] = "posts.status = $status";
        }
        $query = "SELECT * FROM blog_schema.posts join blog_schema.categories on posts.categoryId = categories.categoryId where userId = $userId";
        if (!empty($conditions)) {
            $query .= " AND " . implode(" AND ", $conditions);
        }

        $result = $this->connection->query($query);

        if ($result->num_rows > 0) {
            $posts = [];
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
            return $posts;
        } else {
            return [];
        };
    }




    public function acceptPost($postId)
    {
        $this->connection->query("UPDATE posts SET status = 1 WHERE postId = $postId");
    }

    public function declinePost($postId)
    {
        $this->connection->query("UPDATE posts SET status = -1 WHERE postId = $postId");
    }

}
