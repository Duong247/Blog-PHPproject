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

    public function closeConnection(): void
    {
        $this->mysqli->close();
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
}
