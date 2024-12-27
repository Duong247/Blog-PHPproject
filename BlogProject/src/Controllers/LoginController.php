<?php

namespace App\Controllers;

use App\Controller;
use App\Models\User;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class LoginController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        if (isset($_SESSION['currentUser'])) {
            header('location: /');
            exit();
        }
        $this->render('login\index', []);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Tất cả các trường là bắt buộc!';
                // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                $_SESSION['form_data'] = $_POST;
                return $this->render('login/index');
            }

            $emailUser = $this->userModel->checkLogin($email, $password);
            if ($emailUser == null) {
                $_SESSION['error'] = 'Tài khoản hoặc mật khẩu không đúng!';
                // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                $_SESSION['form_data'] = $_POST;
                return $this->render('login/index');
            } else {
                if ($this->userModel->isEmailVerified($email) == false) {
                    $_SESSION['error'] = 'Hãy xác thực tài khoản để đăng nhập!';

                    // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                    $_SESSION['form_data'] = $_POST;
                    $this->sendVerificationEmail($email);
                } else {
                    $_SESSION['currentUser'] = $emailUser;
                    header('Location: /');
                    exit();
                }
            }
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