<?php

namespace App\Controllers;

use App\Models\User;
use App\Controller;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function verifyEmailForm()
    {
        // Hiển thị trang đăng ký
        return $this->render('user\verifyEmail');
    }

    public function verifyEmail()
    {
        // Kiểm tra xem có mã xác thực trong POST không
        if (isset($_POST['verification_code'])) {
            $verificationCode = $_POST['verification_code'];

            // Gọi phương thức verifyEmail từ UserModel để xác thực mã
            $isVerified = $this->userModel->verifyEmail($verificationCode);

            // Kiểm tra kết quả xác thực
            if ($isVerified) {
                session_start();
                // Nếu xác thực thành công, thông báo và chuyển hướng người dùng
                $_SESSION['message'] = 'Email đã được xác thực thành công!';
                if (!isset($_SESSION['email'])) {
                    unset($_SESSION['email']);
                }
                header('Location: /login/index');
                exit();
            } else {
                // Nếu mã không hợp lệ hoặc hết hạn, hiển thị lỗi
                $_SESSION['error'] = 'Mã xác thực không hợp lệ hoặc đã hết hạn!';
                $this->render('user\verifyEmail');
            }
        }
    }

    public function sendVerificationEmailAgain()
    {
        session_start();
        // Kiểm tra xem email có tồn tại trong session không
        if (!isset($_SESSION['email'])) {
            $_SESSION['error'] = 'Không tìm thấy email cần xác thực trong phiên làm việc.';
            return $this->render('user\verifyEmail'); // Quay lại trang xác thực
        }

        $email = $_SESSION['email']; // Lấy email từ session

        // Tạo mã xác thực (token ngẫu nhiên)
        $verificationToken = rand(100000, 999999); // Token xác thực ngẫu nhiên

        // Lưu token vào CSDL
        try {
            $this->userModel->storeVerificationToken($email, $verificationToken);
        } catch (Exception $e) {
            $_SESSION['error'] = 'Có lỗi xảy ra khi lưu mã xác thực vào cơ sở dữ liệu: ' . $e->getMessage();
            return $this->render('user\verifyEmail'); // Quay lại trang xác thực
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
            $mail->setFrom(SMTP_USER, 'ITC Blog');
            $mail->addAddress($email);

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = iconv_mime_encode('Subject', 'Xác thực email của bạn', array(
                'input-charset' => 'UTF-8',
                'output-charset' => 'UTF-8',
                'line-length' => 76,
                'line-break-chars' => "\r\n"
            ));
            $mail->Body = 'Mã xác thực của bạn là: <strong>' . $verificationToken . '</strong><br><br>Vui lòng nhập mã này vào trang xác thực của chúng tôi.';

            // Gửi email
            $mail->send();

            // Thông báo thành công và điều hướng
            $_SESSION['message'] = 'Email xác thực lại đã được gửi. Vui lòng kiểm tra hộp thư của bạn.';
            return $this->render('user\verifyEmail'); // Chuyển đến trang xác thực
        } catch (Exception $e) {
            // Nếu có lỗi khi gửi email
            $_SESSION['error'] = 'Có lỗi xảy ra khi gửi email xác thực lại: ' . $e->getMessage();
            return $this->render('user\verifyEmail'); // Quay lại trang xác thực
        }
    }
    public function formEmailChangePass()
    {
        return $this->render('user\forgotPass');
    }

    public function sendTokenChangePass()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            if (empty($email)) {
                $_SESSION['error'] = 'Tất cả các trường là bắt buộc!';

                $_SESSION['form_data'] = $_POST;
                return $this->render('user\forgotPass');
            }

            $user = $this->userModel->getUserByEmail($email);
            if ($user == null) {
                $_SESSION['error'] = 'Email không tồn tại!';

                $_SESSION['form_data'] = $_POST;
                return $this->render('user\forgotPass');
            } else {
                $this->sendTokenToChangePass($email);
                exit();
            }
        }
    }

    private function sendTokenToChangePass($email)
    {
        $passresetToken = bin2hex(random_bytes(16)); // Token xác thực ngẫu nhiên
        $this->userModel->storeChangePassToken($email, $passresetToken); // Lưu token vào CSDL
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
            $mail->Subject = iconv_mime_encode('Subject', 'Đổi mật khẩu mới', array(
                'input-charset' => 'UTF-8',
                'output-charset' => 'UTF-8',
                'line-length' => 76,
                'line-break-chars' => "\r\n"
            ));

            // Đường dẫn chứa token
            $resetLink = 'http://localhost:3000/user/change-pass-email?token=' . urlencode($passresetToken);

            // Nội dung email
            $mail->Body = 'Bạn đã yêu cầu đổi mật khẩu. Vui lòng nhấp vào liên kết bên dưới để tiếp tục đổi mật khẩu: <br><br>' .
                '<a href="' . $resetLink . '" target="_blank">Đổi mật khẩu</a><br><br>' .
                'Nếu bạn không yêu cầu, vui lòng bỏ qua email này.';

            $mail->send();
            session_start();
            $_SESSION['message'] = 'Đã gửi link thay đổi mật khẩu đến email của bạn';
            unset($_SESSION['form_data']);
            header('location: /user/change-pass');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = 'Có lỗi xảy ra khi gửi email xác thực: ' . $e->getMessage();
        }
    }

    public function checkTokenChangePass()
    {
        $token = $_GET['token'] ?? null;

        if (!$token) {
            session_start();
            $_SESSION['message'] = 'Token không hợp lệ.';
            header('location: /user/change-pass');
            exit(); // Trang báo lỗi
        }

        // Kiểm tra token trong cơ sở dữ liệu
        if ($this->userModel->verifyTokenChangePass($token) == null) {
            session_start();
            $_SESSION['message'] = 'Token không hợp lệ hoặc đã hết hạn.';
            header('location: /user/change-pass');
            exit();
        }
        $email = $this->userModel->verifyTokenChangePass($token);
        // Nếu token hợp lệ, chuyển đến form đổi mật khẩu
        return $this->render('user\changePassByEmail', ['email' => $email]);
    }

    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Kiểm tra mật khẩu khớp nhau
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = 'Mật khẩu xác nhận không khớp.';
                return $this->render('user\changePassByEmail', ['email' => $email]);
            }

            // Cập nhật mật khẩu
            if ($this->userModel->resetPassword($email, $newPassword)) {
                session_start();
                $_SESSION['message'] = 'Đổi mật khẩu thành công!';
                header('Location: /login/index');
                exit();
            } else {
                $_SESSION['error'] = 'Có lỗi xảy ra. Vui lòng thử lại.';
                return $this->render('user\changePassByEmail', ['email' => $email]);
            }
        }
    }


    public function profile()
    {
        session_start();
        if (!isset($_SESSION['currentUser'])) {
            header("Location: /login/index");
            exit;
        }
        $id = $_SESSION['currentUser'];
        $user = $this->userModel->getUserById($id);

        if (!$user) {
            die("Không tìm thấy thông tin người dùng.");
        }

        return $this->render('user\profile', ['user' => $user]);
    }

    public function formUpdateProfile()
    {
        session_start();
        if (!isset($_SESSION['currentUser'])) {
            header("Location: /login/index");
            exit;
        }
        $id = $_SESSION['currentUser'];
        $user = $this->userModel->getUserById($id);

        if (!$user) {
            die("Không tìm thấy thông tin người dùng.");
        }
        return $this->render('user\updateProfile', ['user' => $user]);
    }

    public function updateProfile()
    {
        // Khởi tạo session (nếu chưa có)
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin từ form
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $oldPhoto = $_POST['oldPhoto'];
            $photo = null;  // Khai báo biến photo

            // Kiểm tra nếu có file ảnh mới
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $fileTmpPath = $_FILES['photo']['tmp_name'];
                $fileName = $_FILES['photo']['name'];
                $fileSize = $_FILES['photo']['size'];
                $fileType = $_FILES['photo']['type'];

                // Đặt đường dẫn và tên file mới
                $uploadDir = 'assets/images/photo/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true); // Tạo thư mục nếu chưa tồn tại
                }

                $fileNameNew = time() . '_' . $fileName;  // Đặt tên mới cho ảnh (thêm timestamp để tránh trùng lặp)

                // Check file size (limit: 5MB)
                if ($fileSize > 5000000) {
                    $_SESSION['error'] = "File của bạn > 5MB";
                    $_SESSION['form_data'] = $_POST;
                    header("Location: /user/form-update-profile");
                    exit();
                }

                // Kiểm tra loại file (chỉ cho phép ảnh JPEG, PNG, GIF và JPG)
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['error'] = "Chỉ hỗ trợ ảnh JPEG, PNG, GIF và JPG!";
                    $_SESSION['form_data'] = $_POST;
                    header("Location: /user/form-update-profile");
                    exit();
                }

                error_log("Ảnh đã được lưu tại: " . $fileTmpPath);
                // Di chuyển ảnh đến thư mục lưu trữ
                if (move_uploaded_file($fileTmpPath, $uploadDir . $fileNameNew)) {
                    // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
                    $photo = $fileNameNew;
                    error_log("Ảnh đã được lưu tại: " . $fileTmpPath . $uploadDir . $fileNameNew);
                } else {
                    $error = error_get_last();
                    $_SESSION['error'] = "Lỗi khi tải ảnh lên: " . ($error ? $error['message'] : "Không rõ lỗi");

                    $_SESSION['form_data'] = $_POST;
                    header("Location: /user/form-update-profile");
                    exit();
                }
            }
            // Nếu không có ảnh mới, giữ ảnh cũ
            if ($photo === null) {
                $photo = $oldPhoto;
            }
            // Cập nhật thông tin người dùng trong cơ sở dữ liệu
            $this->userModel->updateNameAndPhoto($firstName, $lastName, $photo, $_SESSION['currentUser']);
            unset($_SESSION['form_data']);
            $_SESSION['message'] = "Cập nhật thông tin thành công!";
            $user = $this->userModel->getUserById($_SESSION['currentUser']);
            $_SESSION['user'] = $user;
            header("Location: /user/profile");
            exit();
        }
    }

    public function formChangePass()
    {
        session_start();
        if (!isset($_SESSION['currentUser'])) {
            header("Location: /login/index");
            exit;
        }
        return $this->render('user\changePass');
    }

    public function changePass()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $oldpass = $_POST['oldpass'];
            $newpass = $_POST['newpass'];
            $confirmpass = $_POST['confirmpass'];

            if (
                $newpass !== $confirmpass
            ) {
                $_SESSION['error'] = 'Mật khẩu không khớp!';
                // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                $_SESSION['form_data'] = $_POST;
                return $this->render('user/changePass');
            }

            if (!$this->userModel->changePassword($_SESSION['currentUser'], $oldpass, $newpass)) {
                $_SESSION['error'] = 'Mật khẩu không đúng!';
                // Đảm bảo giữ lại dữ liệu nhập vào khi có lỗi
                $_SESSION['form_data'] = $_POST;
                return $this->render('user/changePass');
            } else {
                unset($_SESSION['form_data']);
                $_SESSION['message'] = 'Đổi mật khẩu thành công.';
                $id = $_SESSION['currentUser'];
                $user = $this->userModel->getUserById($id);

                if (!$user) {
                    die("Không tìm thấy thông tin người dùng.");
                }

                return $this->render('user\profile', ['user' => $user]);
            }
        }
    }


    public function logout()
    {
        // Chỉ xử lý khi yêu cầu là POST
        // Bắt đầu session một cách an toàn
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Xóa toàn bộ session thay vì chỉ unset một phần tử
        $_SESSION = [];
        session_destroy();
        // Chuyển hướng về trang chủ
        header("Location: /");
        exit();
    }

    

}
