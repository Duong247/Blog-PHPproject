<?php ob_start(); ?>
    <h1>Post Form</h1>
    <form action="/post/<?= isset($post['id']) ? "update/$post[id]" : 'create' ?>" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= isset($post['title']) ? $post['title'] : '' ?>" required><br>

        <label for="content">Content:</label>
        <input type="text" id="content" name="content" value="<?= isset($post['content']) ? $post['content'] : '' ?>" ><br>


        <input type="submit" value="<?= isset($post['id']) ? 'Update' : 'Create' ?>">
    </form>
    <a href="/index.php">Back to Post List</a>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ .  '/../../../templates/layout.php'); ?>
