<?php ob_start(); ?>
<style>
    body {
        background-color: #FFF;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .profile-container {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        padding: 25px;
    }

    .profile-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-header h1 {
        font-size: 26px;
        color: #F48840;
        font-weight: bold;
    }

    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: white;
        margin: 0 auto 20px;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-control-plaintext {
        background-color: transparent;
        border: none;
        font-size: 16px;
        color: #333;
    }

    .form-control-plaintext:hover {
        background-color: #f1f1f1;
    }

    .form-group label {
        font-weight: bold;
        font-size: 16px;
        color: #555;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: none;
        color: #333;
        width: 100%;
        padding: 12px;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #F48840;
        box-shadow: 0 0 5px rgba(255, 127, 80, 0.5);
    }

    .btn-primary {
        background-color: #F48840;
        border: none;
        color: #fff;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #E5673D;
    }

    .footer {
        text-align: center;
        margin-top: 30px;
        color: #888;
        font-size: 14px;
    }

    .footer a {
        color: #F48840;
        text-decoration: none;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 15px;
    }

    /* Đảm bảo responsive cho màn hình nhỏ */
    @media (max-width: 768px) {
        .profile-container {
            padding: 15px;
            margin: 20px auto;
        }

        .avatar {
            width: 100px;
            height: 100px;
            font-size: 40px;
        }

        .profile-header h1 {
            font-size: 22px;
        }

        .btn-primary {
            font-size: 14px;
            padding: 10px;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-header"
        style="display: flex; align-items: center; justify-content: center; width: 100%; position: relative;">
        <h1 style="font-size: 26px; color: #F48840; margin: 0;">
            Thông tin cá nhân
        </h1>
        <i class="edit-icon" style="font-size: 30px; margin-left: 10px; position: absolute; right: 0;">
            <a href="/user/form-update-profile" style="color: #F48840;">&#9998;</a>
        </i>
    </div>
    <!-- Hiển thị ảnh đại diện -->
    <div class="avatar">
        <?php if ($user['photo'] != null): ?>
            <img src="/assets/images/photo/<?php echo htmlspecialchars($user['photo']); ?>" alt="Avatar">

        <?php else: ?>
            <img src="/templates/assets/images/noPhoto.png" alt="Avatar">
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="fullname">Họ và tên</label>
        <p class="form-control-plaintext" id="fullname">
            <?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?>
        </p>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <p class="form-control-plaintext" id="email">
            <?php echo htmlspecialchars($user['email']); ?></p>
    </div>

    <!-- Thông báo lỗi -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Thay đổi mật khẩu -->
    <form action="/user/form-change-pass" method="POST" style="margin-top: 30px;">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"
                style="height: 50px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                <i class="fa fa-key" style="margin-right: 10px;"></i> Đổi mật khẩu
            </button>
        </div>
    </form>
    <a href="/" class="btn btn-secondary"
        style="height: 50px; display: flex; align-items: center; justify-content: center; font-size: 16px;">
        Quay lại
    </a>
    <?php
    // Kiểm tra nếu có thông báo trong session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['message'])):
    ?>
        <script>
            // Hiển thị thông báo từ session bằng alert trong JavaScript
            alert("<?php echo $_SESSION['message']; ?>");
            <?php unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị 
            ?>
        </script>
    <?php endif; ?>


</div>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>