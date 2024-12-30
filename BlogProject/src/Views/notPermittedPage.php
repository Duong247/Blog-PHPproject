<?php ob_start(); ?>
<div class="container">
    <h1 class="text-center mt-5">Bạn không có quyền truy cập. Trở lại <a style="color: #F48840" href="/">Trang chủ</a></h1>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../templates/layout.php'); ?>