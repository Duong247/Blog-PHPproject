<?php ob_start(); ?>
<div class="container">
    <h2>Quản lý bài đăng</h2>


    <table class="table mt-3 table-bordered">
        <thead>
            <tr>
                <th scope="col">Ảnh</th>
                <th scope="col">Tên bài viết</th>
                <th scope="col">Thể loại</th>
                <th scope="col">Thời điểm đăng</th>
                <th scope="col">Trạng thái</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post){?>
                <tr>
                    <td class="text-center"><img src="assets/images/postImage/<?=$post['photo']?>" class="img-thumbnail" alt="..." style="width: 80px;"></td>
                    <td><?=$post['postName']?></td>
                    <td><?=$post['categoryName']?></td>
                    <td><?=$post['uploadTime']?></td>
                    <td>
                        <?php if ((int)$post['status'] == 0) { ?>
                            <span style="padding: 8px; font-size: 16px" class="badge badge-secondary">Chưa duyệt</span>
                        <?php } else { ?>
                            <span style="padding: 8px; font-size: 16px" class="badge badge-success">Đã duyệt</span>
                        <?php } ?>

                    </td>
                    <td style="width: 80px;">
                        <div class="<?=$post['status'] == 0?"d-flex ":"text-center " ?> justify-content-between">
                            <a <?=$post['status'] == 0?"":"hidden" ?> type="button" class="btn btn-primary" style="margin: 1px;" href="post/update/<?=$post['postId']?>"><i class="fa-solid fa-pencil" style="color: #fff;"></i></a>
                            <a type="button" class="btn btn-danger" style="margin: 1px;" href="post/delete/<?=$post['postId']?>"><i class="fa-solid fa-trash" style="color: #fff;"></i></a>
                        </div>
                    </td>
                </tr>
                
            <?php }?>

            
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../templates/layout.php'); ?>