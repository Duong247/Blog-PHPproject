<?php

namespace App\Models;

use mysqli;
use Exception;

class User
{
    private $mysqli;

    public function __construct()
    {
        $this->connectDatabase();
    }

    private function connectDatabase()
    {
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $this->mysqli = new mysqli($host, $username, $password, $database);

        if ($this->mysqli->connect_error) {
            throw new Exception("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getUserById(int $id): ?array
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }


    public function createUser(string $email, string $password, string $firstName, string $lastName): bool
    {
        // Hash mật khẩu
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Tạo token xác thực email
        $emailVerificationToken = bin2hex(random_bytes(16));

        // Câu lệnh SQL để thêm người dùng vào cơ sở dữ liệu
        $stmt = $this->mysqli->prepare(
            "INSERT INTO users (email, first_name, last_name, password_hash, email_verification_token) 
         VALUES (?, ?, ?, ?, ?)"
        );

        // Liên kết các tham số vào câu lệnh SQL
        $stmt->bind_param("sssss", $email, $firstName, $lastName, $hashedPassword, $emailVerificationToken);

        // Thực thi câu lệnh SQL và trả về kết quả
        return $stmt->execute();
    }


    public function verifyEmail(string $token): bool
    {
        $stmt = $this->mysqli->prepare(
            "SELECT id FROM users WHERE email_verification_token = ? AND token_expiry > NOW()"
        );
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $stmt = $this->mysqli->prepare(
                "UPDATE users SET is_email_verified = 1, email_verification_token = NULL, token_expiry = NULL WHERE id = ?"
            );
            $stmt->bind_param("i", $user['id']);
            return $stmt->execute();
        }

        return false;
    }

    public function verifyTokenChangePass(string $token): ?string
    {
        $stmt = $this->mysqli->prepare(
            "SELECT email FROM users WHERE password_reset_token = ? AND token_expiry > NOW()"
        );
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            return $user['email'];
        }

        return null;
    }

    public function storeChangePassToken(string $email, string $token): bool
    {
        $stmt = $this->mysqli->prepare(
            "UPDATE users SET password_reset_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?"
        );
        $stmt->bind_param("ss", $token, $email);
        return $stmt->execute();
    }

    public function resetPassword(string $email, string $newPassword): bool
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->mysqli->prepare(
            "UPDATE users SET password_hash = ?, password_reset_token = NULL WHERE email = ?"
        );
        $stmt->bind_param("ss", $hashedPassword, $email);
        return $stmt->execute();
    }

    public function storeVerificationToken(string $email, string $verificationToken): bool
    {
        $stmt = $this->mysqli->prepare(
            "UPDATE users SET email_verification_token = ?, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?"
        );
        $stmt->bind_param("ss", $verificationToken, $email);
        return $stmt->execute();
    }
    public function isEmailVerified(string $email): bool
    {
        // Truy vấn trạng thái xác thực email từ cơ sở dữ liệu
        $stmt = $this->mysqli->prepare("SELECT is_email_verified FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Kiểm tra nếu email tồn tại và đã xác thực
        return $user && $user['is_email_verified'] == 1;
    }

    public function checkLogin(string $email, string $password): ?int
    {
        // Truy vấn người dùng bằng email
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Kiểm tra xem người dùng có tồn tại và mật khẩu có khớp không
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user['id']; // Trả về thông tin người dùng nếu đăng nhập thành công
        }

        // Nếu không khớp, trả về null
        return null;
    }

    public function updateName(int $userId, string $firstName, string $lastName): bool
    {
        // Kiểm tra nếu tên hoặc họ trống
        if (empty($firstName) || empty($lastName)) {
            return false;  // Trả về false nếu dữ liệu không hợp lệ
        }

        // Câu lệnh SQL để cập nhật tên người dùng
        $stmt = $this->mysqli->prepare(
            "UPDATE users SET first_name = ?, last_name = ? WHERE id = ?"
        );

        // Liên kết các tham số vào câu lệnh SQL
        $stmt->bind_param("ssi", $firstName, $lastName, $userId);

        // Thực thi câu lệnh SQL và trả về kết quả
        return $stmt->execute();
    }

    public function updateNameAndPhoto(string $firstName, string $lastName, ?string $photo, int $id): bool
    {
        // Nếu không có ảnh mới, giữ lại giá trị null hoặc tên ảnh cũ
        if ($photo === null) {
            $photo = null;
        }

        // Câu lệnh SQL để cập nhật tên và ảnh người dùng
        $stmt = $this->mysqli->prepare(
            "UPDATE users SET first_name = ?, last_name = ?, photo = ? WHERE id = ?"
        );

        // Nếu không có ảnh mới, gán giá trị null vào tham số photo
        $stmt->bind_param("ssss", $firstName, $lastName, $photo, $id);

        // Thực thi câu lệnh SQL và trả về kết quả
        return $stmt->execute();
    }

    public function changePassword(string $id, string $oldPassword, string $newPassword): bool
    {
        // Khai báo biến $hashedPassword trước khi sử dụng
        $hashedPassword = null;

        // Truy vấn lấy mật khẩu đã mã hóa từ cơ sở dữ liệu theo email
        $stmt = $this->mysqli->prepare("SELECT password_hash FROM users WHERE id = ?");
        if ($stmt === false) {
            return false; // Kiểm tra lỗi chuẩn bị câu lệnh SQL
        }

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->store_result();

        // Liên kết kết quả và lấy mật khẩu đã mã hóa
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();  // Lấy giá trị đầu tiên trong kết quả

        // Kiểm tra nếu không có mật khẩu đã mã hóa (trường hợp không có kết quả)
        if (!isset($hashedPassword)) {
            return false; // Không có mật khẩu đã mã hóa
        }

        // Kiểm tra mật khẩu cũ có khớp không
        if (!password_verify($oldPassword, $hashedPassword)) {
            return false; // Mật khẩu cũ không đúng
        }

        // Mã hóa mật khẩu mới
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Cập nhật mật khẩu mới vào cơ sở dữ liệu
        $stmt = $this->mysqli->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        if ($stmt === false) {
            return false; // Kiểm tra lỗi chuẩn bị câu lệnh SQL
        }

        $stmt->bind_param("ss", $newHashedPassword, $id);

        // Thực thi câu lệnh SQL và trả về kết quả
        if ($stmt->execute()) {
            // Kiểm tra số dòng bị ảnh hưởng
            if ($stmt->affected_rows > 0) {
                return true; // Cập nhật thành công
            }
        }

        return false; // Không có thay đổi (có thể do email không tồn tại hoặc lỗi)
    }



    public function closeConnection(): void
    {
        $this->mysqli->close();
    }

    public function __destruct()
    {
        $this->closeConnection();
    }


    //Admin
    public function getAllUsers(){
        $stmt = $this->mysqli->prepare(" SELECT 	users.id, users.first_name, users.last_name, users.email, users.created_at, role, COALESCE(Count(posts.postId), 0) as quantityPosts
                                                FROM 	posts RIGHT JOIN users on posts.userId = users.id
                                                GROUP BY users.first_name, users.last_name, users.email, users.created_at, role;");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function searchUser($searchvalue){
        $searchvalue= $this->mysqli->real_escape_string($searchvalue);
        $stmt = $this->mysqli->prepare(" SELECT users.id, users.first_name, users.last_name, users.email, users.created_at, role, COALESCE(COUNT(posts.postId), 0) AS quantityPosts
                                                FROM blog_schema.posts RIGHT JOIN  blog_schema.users ON posts.userId = users.id
                                                WHERE 
                                                    email LIKE '%$searchvalue%' OR first_name LIKE '%$searchvalue%' OR last_name LIKE '%$searchvalue%'
                                                GROUP BY 
                                                    users.id, users.first_name, users.last_name, users.email, users.created_at, role;");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
