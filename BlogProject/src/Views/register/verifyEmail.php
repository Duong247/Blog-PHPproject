<?php ob_start(); ?>
<style>
    body {
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .verify-container {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .verify-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .verify-header h1 {
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

<div class="verify-container">
    <div class="verify-header">
        <h1>Xác thực tài khoản</h1>
    </div>

    <form action="/user/verify" method="POST">
        <div class="mb-3">
            <label for="verification_code" class="form-label">Mã xác thực</label>
            <input type="text" class="form-control" id="verification_code" name="verification_code"
                placeholder="Nhập mã xác thực" required>
        </div>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>

        <?php endif; ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['message'];
                unset($_SESSION['message']); ?>
            </div>

        <?php endif; ?>
        <button type="submit" class="btn btn-primary w-100">Xác thực</button>
    </form>
    <div class="footer">
        <p>Chưa nhận được mã? <a href="/resend-verification">Gửi lại mã xác thực</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>