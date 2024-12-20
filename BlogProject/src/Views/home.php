<?php ob_start(); ?>
<div class="container">
    <h2>haha</h2>
</div>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../templates/layout.php'); ?>