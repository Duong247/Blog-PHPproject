<?php

namespace App\Models;
//require_once(__DIR__ . '/../../config.php');

class Category
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



    public function getAllCategory()
    {
        $result = $this->connection->query(" SELECT categories.categoryId,categoryName, COUNT(posts.postId) AS postCount
                                                    FROM categories LEFT JOIN posts ON categories.categoryId = posts.categoryId
                                                    GROUP BY categories.categoryId, categoryName;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createCategory($categoryName){
        $categoryName = $this->connection->real_escape_string($categoryName);
        $this->connection->query("INSERT INTO categories (categoryName) VALUES ('$categoryName')");
    }

    public function updateCategory($categoryId,$categoryName){
        $categoryId = $this->connection->real_escape_string($categoryId);
        $this->connection->query(" UPDATE categories SET categoryName = '$categoryName' WHERE categoryId = $categoryId;");
    }

    public function deleteCategory($categoryId){
        $categoryId = $this->connection->real_escape_string(string: $categoryId);
        $this->connection->query("   DELETE FROM comments
                                            WHERE postId IN (
                                                SELECT postId 
                                                FROM posts 
                                                WHERE categoryId = $categoryId
                                            );");
        $this->connection->query(" DELETE FROM posts WHERE categoryId = $categoryId");
        $this->connection->query(" DELETE FROM categories Where categoryId=$categoryId");
    }
    
    public function getCategoryById($categoryId){
        $categoryId = $this->connection->real_escape_string($categoryId);
        $result = $this->connection->query("SELECT * FROM categories WHERE categoryId = $categoryId");
        return $result->fetch_assoc();
    }

    public function searchCategories($searchvalue){
        $searchvalue= $this->connection->real_escape_string($searchvalue);
        $stmt = $this->connection->prepare(" SELECT categories.categoryId,categoryName, COUNT(posts.postId) AS postCount
                                                    FROM categories LEFT JOIN posts ON categories.categoryId = posts.categoryId
                                                    WHERE categoryName LIKE '%$searchvalue%'
                                                    GROUP BY categories.categoryId, categoryName;
                                                    ");
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}


