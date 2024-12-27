<?php ob_start(); ?>
<style>
    body {
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .reset-container {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .reset-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .reset-header h1 {
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

    .footer {
        text-align: center;
        margin-top: 15px;
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
</style>

<div class="reset-container">
    <div class="reset-header">
        <h1>Đổi mật khẩu</h1>
    </div>

    <form action="/user/process-change-pass" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="oldpass" class="form-label">Mật khẩu hiện tại</label>
            <input type="password" class="form-control" id="oldpass" name="oldpass"
                value="<?php echo isset($_SESSION['form_data']['oldpass']) ? $_SESSION['form_data']['oldpass'] : ''; ?>"
                placeholder="Nhập mật khẩu hiện tại của bạn" required>
        </div>
        <div class="mb-3">
            <label for="newpass" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" id="newpass" name="newpass"
                value="<?php echo isset($_SESSION['form_data']['newpass']) ? $_SESSION['form_data']['newpass'] : ''; ?>"
                placeholder="Nhập mật khẩu mới của bạn" required>
        </div>
        <div class="mb-3">
            <label for="confirmpass" class="form-label">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirmpass" name="confirmpass"
                value="<?php echo isset($_SESSION['form_data']['confirmpass']) ? $_SESSION['form_data']['confirmpass'] : ''; ?>"
                placeholder="Xác nhận lại mật khẩu mới của bạn" required>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <div class="form-group d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-primary" style="width: 30%;">
                <i class="fa fa-key"></i> Thay đổi
            </button>
            <a href="/user/profile" class="btn btn-secondary">
                Quay lại
            </a>
        </div>


    </form>
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