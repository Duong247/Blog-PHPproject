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

    .reset-container {
        max-width: 400px;
        padding: 24px 28px;
        margin: 50px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
        padding: 20px;
    }

    .reset-header {
        text-align: center;
        margin-bottom: 20px;
        padding: 8px 0;
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

    .avatar{
        text-align: center;
        padding: 12px;
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
        <h1>Cập nhật thông tin cá nhân</h1>
    </div>

    <form action="/user/process-update-profile" method="POST" enctype="multipart/form-data">
        <!-- Hiển thị ảnh hiện tại và chọn ảnh mới -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Ảnh đại diện</label>
            <div class="avatar">
                <?php
                $photoPath = !empty($user['photo']) ? '/assets/images/photo/' . htmlspecialchars($user['photo']) : '/templates/assets/images/noPhoto.png';
                ?>
                <img id="previewPhoto" src="<?php echo $photoPath; ?>" alt="Avatar"
                    style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
            </div>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                onchange="previewImage(this)">
            <input type="hidden" class="form-control" id="oldPhoto" name="oldPhoto"
                value="<?php echo htmlspecialchars($user['photo'] ?? '/templates/assets/images/noPhoto.png'); ?>">
        </div>

        <div class="mb-3">
            <label for="firstname" class="form-label">Họ đệm</label>
            <input type="firstname" class="form-control" id="firstname" name="firstname"
                value="<?php echo isset($_SESSION['form_data']['firstname']) ? $_SESSION['form_data']['firstname'] : $user['first_name']; ?>"
                placeholder="Nhập họ đệm của bạn" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Tên</label>
            <input type="lastname" class="form-control" id="lastname" name="lastname"
                value="<?php echo isset($_SESSION['form_data']['lastname']) ? $_SESSION['form_data']['lastname'] : $user['last_name']; ?>"
                placeholder="Nhập tên của bạn" required>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <div style="padding-top: 24px" class="form-group d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary" style="width: 30%;">
                <i class="fa fa-floppy-o"></i> Chỉnh sửa
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
<script>
    function previewImage(input) {
        const preview = document.getElementById('previewPhoto');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // Cập nhật src của ảnh
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>