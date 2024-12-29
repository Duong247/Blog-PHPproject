<?php ob_start(); ?>
<style>
body {
    background-color: #fff;
    font-family: Arial, sans-serif;
    color: #333;
}

.reset-container {
    max-width: 400px;
    margin: 50px auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
    padding: 20px;
}

.reset-header {
    text-align: center;
    margin-bottom: 20px;
}

.reset-header h1 {
    font-size: 24px;
    color: #F48840;
    font-weight: bold;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: none;
    color: #333;
}

.form-control:focus {
    border-color: #F48840;
    box-shadow: 0 0 5px rgba(255, 127, 80, 0.5);
}

.btn-primary {
    background-color: #F48840;
    border: none;
    color: #fff;
}

.btn-primary:hover {
    background-color: #E5673D;
}

.footer {
    text-align: center;
    margin-top: 15px;
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
</style>

<div class="reset-container">
    <div class="reset-header">
        <h1>Quên mật khẩu</h1>
    </div>

    <form action="user/send-email-token" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>"
                placeholder="Nhập email của bạn" required>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
        </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary w-100">Gửi yêu cầu</button>
    </form>
    <div class="footer">
        <p>Nhớ mật khẩu? <a href="/login/index">Đăng nhập</a></p>
    </div>
</div>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['message'])):
?>
<script>
// Hiển thị thông báo từ session bằng alert trong JavaScript
alert("<?php echo $_SESSION['message']; ?>");
<?php unset($_SESSION['message']); ?>
</script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>