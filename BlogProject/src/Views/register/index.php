<?php ob_start(); ?>
<style>
    body {
        background-color: #fff;
        font-family: Arial, sans-serif;
        color: #333;
    }

    label{
        font-weight: bold;
    }

    .register-container {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        padding: 20px;
    }

    .register-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .register-header h1 {
        font-size: 24px;
        color: #FF7F50;
        font-weight: bold;
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

    .error-message {
        color: red;
        font-size: 14px;
        margin-bottom: 15px;
    }
</style>

<div class="register-container">
    <div class="register-header">
        <h1>Đăng ký</h1>
    </div>

    <form action="/register" method="POST">
        <div class="mb-3">
            <label for="first_name" class="form-label">Họ đệm</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Họ đệm của bạn"
                value="<?php echo isset($_SESSION['form_data']['first_name']) ? $_SESSION['form_data']['first_name'] : ''; ?>"
                required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Tên của bạn"
                value="<?php echo isset($_SESSION['form_data']['last_name']) ? $_SESSION['form_data']['last_name'] : ''; ?>"
                required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email của bạn"
                value="<?php echo isset($_SESSION['form_data']['email']) ? $_SESSION['form_data']['email'] : ''; ?>"
                required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu của bạn"
                value="<?php echo isset($_SESSION['form_data']['password']) ? $_SESSION['form_data']['password'] : ''; ?>"
                required>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Mật khẩu xác nhận</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                placeholder="Mật khẩu xác nhận"
                value="<?php echo isset($_SESSION['form_data']['confirm_password']) ? $_SESSION['form_data']['confirm_password'] : ''; ?>"
                required>
        </div>
        <?php

        if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
    </form>
    <div class="footer">
        <p>Đã có tài khoản? <a href="/login/index">Đăng nhập</a></p>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>