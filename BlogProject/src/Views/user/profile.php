<?php ob_start(); ?>
<style>
body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
    color: #333;
}

.profile-container {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    padding: 25px;
}

.profile-header {
    text-align: center;
    margin-bottom: 30px;
}

.profile-header h1 {
    font-size: 26px;
    color: #FF7F50;
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
    cursor: pointer;
    position: relative;
    transition: transform 0.3s ease;
}

.avatar:hover {
    transform: scale(1.05);
}

.avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.avatar .edit-icon {
    position: absolute;
    bottom: 5px;
    right: 5px;
    font-size: 20px;
    color: #FF7F50;
    background-color: white;
    border-radius: 50%;
    padding: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.avatar .edit-icon:hover {
    background-color: #FF7F50;
    color: white;
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
    border-color: #FF7F50;
    box-shadow: 0 0 5px rgba(255, 127, 80, 0.5);
}

.btn-primary {
    background-color: #FF7F50;
    border: none;
    color: #fff;
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border-radius: 5px;
    margin-top: 30px;
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
    color: #FF7F50;
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
    <div class="profile-header">
        <h1>Thông tin cá nhân</h1>
    </div>


    <!-- Hiển thị ảnh đại diện -->
    <div class="avatar">
        <?php if (isset($photoUrl) && !empty($photoUrl)): ?>
        <img src="<?php echo $photoUrl; ?>" alt="Avatar">
        <?php else: ?>
        <span>?</span> <!-- Biểu tượng cho avatar trống -->
        <?php endif; ?>

        <!-- Biểu tượng chỉnh sửa -->
        <i class="edit-icon" onclick="document.getElementById('photo').click();">&#9998;</i>
    </div>

    <!-- Ảnh đại diện (input file) -->
    <input type="file" id="photo" name="photo" style="display: none;" accept="image/*">

    <form action="/user/updateProfile" method="POST" enctype="multipart/form-data">
        <!-- Phần còn lại của form nếu cần -->
    </form>


    <div class="form-group">
        <label for="fullname">Họ và tên <i class="edit-icon">
                <a href="/user/update-name" style="color: #333;">&#9998;</a></i></label>
        <p class="form-control-plaintext" id="fullname">
            <?php echo htmlspecialchars($user['last_name'] . " " . $user['first_name']); ?>
        </p>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <p class="form-control-plaintext" id="email">
            <?php echo htmlspecialchars($user['email']);?></p>
    </div>

    <!-- Thông báo lỗi -->
    <?php if (isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>


    <!-- Thay đổi mật khẩu -->
    <form action="/user/changePassword" method="POST" style="margin-top: 30px;">
        <button type="submit" class="btn-primary">Đổi mật khẩu</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>