<?php ob_start(); ?>
    <form method="post" action="../user/logout">
        <input type="submit" name="logout" value="Logout">
    </form>
    <h1>Post List</h1>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <a href="/post/show/<?= $post['id'] ?>">
                    <?= $post['title'] ?>
                </a>
                | <a href="/post/update/<?= $post['id'] ?>">Edit</a>
                | <a href="/post/delete/<?= $post['id'] ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="/post/create">Add Post</a>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../../templates/layout.php'); ?>
