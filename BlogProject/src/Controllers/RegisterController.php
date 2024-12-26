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

    public function verifyEmailForm()
    {
        // Hiển thị trang đăng ký
        return $this->render('register/verifyEmail'); // 'register' là tên render của form đăng ký
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
            $mail->setFrom(SMTP_USER, 'Your Application');
            $mail->addAddress($email);

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = mb_encode_mimeheader('Xác thực email của bạn', 'UTF-8', 'Q');

            $mail->Body = 'Mã xác thực: ' . $verificationToken;

            $mail->send();
            return $this->render('register/verifyEmail'); // Chuyển đến trang xác thực
        } catch (Exception $e) {
            $_SESSION['error'] = 'Có lỗi xảy ra khi gửi email xác thực: ' . $e->getMessage();
        }
    }
    public function sendVerificationEmailAgain()
    {
        // Kiểm tra xem email có tồn tại trong session không
        if (!isset($_SESSION['email'])) {
            $_SESSION['error'] = 'Không tìm thấy email cần xác thực trong phiên làm việc.';
            return $this->render('register/verifyEmail'); // Quay lại trang xác thực
        }

        $email = $_SESSION['email']; // Lấy email từ session

        // Tạo mã xác thực (token ngẫu nhiên)
        $verificationToken = rand(100000, 999999); // Token xác thực ngẫu nhiên

        // Lưu token vào CSDL
        try {
            $this->userModel->storeVerificationToken($email, $verificationToken);
        } catch (Exception $e) {
            $_SESSION['error'] = 'Có lỗi xảy ra khi lưu mã xác thực vào cơ sở dữ liệu: ' . $e->getMessage();
            return $this->render('register/verifyEmail'); // Quay lại trang xác thực
        }

        // Gửi email xác thực
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
            $mail->setFrom(SMTP_USER, 'Your Application');
            $mail->addAddress($email);

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = mb_encode_mimeheader('Xác thực lại email của bạn', 'UTF-8', 'Q');
            $mail->Body = 'Mã xác thực của bạn là: <strong>' . $verificationToken . '</strong><br><br>Vui lòng nhập mã này vào trang xác thực của chúng tôi.';

            // Gửi email
            $mail->send();

            // Thông báo thành công và điều hướng
            $_SESSION['message'] = 'Email xác thực lại đã được gửi. Vui lòng kiểm tra hộp thư của bạn.';
            return $this->render('register/verifyEmail'); // Chuyển đến trang xác thực
        } catch (Exception $e) {
            // Nếu có lỗi khi gửi email
            $_SESSION['error'] = 'Có lỗi xảy ra khi gửi email xác thực lại: ' . $e->getMessage();
            return $this->render('register/verifyEmail'); // Quay lại trang xác thực
        }
    }
}
