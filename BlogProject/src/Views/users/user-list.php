
<?php ob_start(); ?>
    <h1>User List</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                
                <a href="/user/show/<?= $user['userId'] ?>">
                    <?= $user['username'] ?>
                </a>
                
                | <a href="/user/update/<?= $user['userId'] ?>">Edit</a>
                | <a href="/user/delete/<?= $user['userId'] ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
    
    <?php
    session_start();

    if(isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        echo $message . '<br>';
    }
    
    ?>
    <a href="/user/create">Add User</a>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../../templates/layout.php'); ?>
<!--
</body>
</html>
-->