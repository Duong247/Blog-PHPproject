<?php ob_start(); ?>
<style>
body {
    background-color: #f4f4f4;
    font-family: Arial, sans-serif;
    color: #333;
}

.change-pass-container {
    max-width: 400px;
    margin: 50px auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.change-pass-header {
    text-align: center;
    margin-bottom: 20px;
}

.change-pass-header h1 {
    font-size: 24px;
    color: #FF7F50;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: none;
    color: #333;
}

.form-control:focus {
    border-color: #FF7F50;
    box-shadow: 0 0 5px rgba(255, 127, 80, 0.5);
}

.btn-primary {
    background-color: #FF7F50;
    border: none;
    color: #fff;
}

.btn-primary:hover {
    background-color: #E5673D;
}

.error-message {
    color: red;
    font-size: 14px;
    margin-bottom: 15px;
}

.success-message {
    color: green;
    font-size: 14px;
    margin-bottom: 15px;
}
</style>

<div class="change-pass-container">
    <div class="change-pass-header">
        <h1>Đổi mật khẩu</h1>
    </div>

    <form action="/user/reset-password" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" />

        <div class="mb-3">
            <label for="new_password" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" id="new_password" name="new_password"
                placeholder="Nhập mật khẩu mới" required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                placeholder="Xác nhận mật khẩu mới" required>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
        </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
            <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
        </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary w-100">Cập nhật mật khẩu</button>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>