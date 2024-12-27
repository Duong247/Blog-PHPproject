<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class RegisterController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }
    // Hàm hiển thị form đăng ký
    public function showRegistrationForm()
    {
        // Hiển thị trang đăng ký
        return $this->render('register/index'); // 'register' là tên render của form đăng ký
    }

    // Hàm xử lý đăng ký người dùng
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form đăng ký
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];

            // Kiểm tra tính hợp lệ của dữ liệu
            if (empty($email) || empty($password) || empty($confirmPassword) || empty($firstName) || empty($lastName)) {
                $_SESSION['error'] = 'Tất cả các trường là bắt buộc!';
                // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                $_SESSION['form_data'] = $_POST;
                return $this->render('register/index');
            }

            if (
                $password !== $confirmPassword
            ) {
                $_SESSION['error'] = 'Mật khẩu không khớp!';
                // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                $_SESSION['form_data'] = $_POST;
                return $this->render('register/index');
            }

            // Kiểm tra email đã tồn tại trong cơ sở dữ liệu chưa
            $existingUser = $this->userModel->getUserByEmail($email);
            if ($existingUser) {
                $_SESSION['error'] = 'Email đã được đăng ký!';
                // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                $_SESSION['form_data'] = $_POST;
                return $this->render('register/index');
            }

            // Tạo người dùng mới
            $this->userModel->createUser(
                $email,
                $password,
                $firstName,
                $lastName
            );

            // Gửi email xác thực với token
            $this->sendVerificationEmail($email);
            return;
        }
    }

    // Hàm gửi email xác thực
    private function sendVerificationEmail($email)
    {

        // Tạo mã xác thực (token ngẫu nhiên)
        $verificationToken = rand(100000, 999999); // Token xác thực ngẫu nhiên
        $this->userModel->storeVerificationToken($email, $verificationToken); // Lưu token vào CSDL
        // Gửi email
        $mail = new PHPMailer(true);
        try {
            // Cấu hình PHPMailer
            $mail->isSMTP();
            $mail->Host = SMTP_HOST; // Sử dụng hằng số cấu hình
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER; // Sử dụng hằng số cấu hình
            $mail->Password = SMTP_PASS; // Sử dụng hằng số cấu hình
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT; // Sử dụng hằng số cấu hình

            // Người gửi và người nhận
            $mail->setFrom(SMTP_USER, 'ITC Blog');
            $mail->addAddress($email);

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = mb_encode_mimeheader('Xác thực email của bạn', 'UTF-8', 'Q');

            $mail->Body = 'Mã xác thực: ' . $verificationToken;

            $mail->send();
            session_start();
            $_SESSION['email'] = $email;
            return $this->render('user\verifyEmail'); // Chuyển đến trang xác thực
        } catch (Exception $e) {
            $_SESSION['error'] = 'Có lỗi xảy ra khi gửi email xác thực: ' . $e->getMessage();
        }
    }
}