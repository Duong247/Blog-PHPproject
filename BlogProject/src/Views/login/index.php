<?php ob_start(); ?>
<style>
    body {
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
        color: #333;
    }

    .login-container {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .login-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .login-header h1 {
        font-size: 24px;
        color: #FF7F50;
        /* Cam */
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
</style>

<div class="login-container">
    <div class="login-header">
        <h1>Đăng nhập</h1>
    </div>
    <form action="/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email của bạn" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password"
                placeholder="Nhập mật khẩu của bạn" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="footer">
        <p>Đăng kí tài khoản ngay! <a href="../register/index.php">Đăng kí</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>