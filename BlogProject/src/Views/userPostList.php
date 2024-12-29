<?php ob_start(); ?>
<div class="container">
    <h2>Bài viết của tôi</h2>
    <hr style="opacity:0.1">

    <div class="input-group mb-3">
        <form class="d-flex w-100 justify-content-between" action="/post/search" method="GET">
            <select style="width: 185px; outline: none" name="status" class="statusFilter text-center" id="status">
                <option  value="">-- Chọn trạng thái --</option>
                <option <?=isset($status)&& $status==1?'selected':'' ?> value="1">Đã duyệt</option>
                <option <?=isset($status)&&$status==0?'selected':'' ?> value="0">Chưa duyệt</option>
                <option <?=isset($status)&&$status==-1?'selected':'' ?> value="-1">Bị từ chối</option>
            </select>
            <div style="width: 85%" class="d-flex justify-content-center">
                <input style="border-radius: 0" type="text" class="form-control" placeholder="Nhập tên bài viết cần tìm kiếm..." aria-label=""
                    name="searchValue" aria-describedby="basic-addon1" value="<?=isset($searchValue)?$searchValue:''?>">
                <div class="input-group-prepend">
                    <button style="border-radius: 0" class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table mt-4 table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center" scope="col" style="width:100px">Hình ảnh</th>
                <th class="text-center" scope="col">Tên bài viết</th>
                <th style="width: 240px;" class="text-center" scope="col">Mô tả</th>
                <th style="width: 200px;" class="text-center" scope="col">Loại</th>
                <th style="width: 200px;" class="text-center" scope="col">Thời gian đăng</th>
                <th style="width: 150px;" class="text-center" scope="col">Trạng thái</th>
                <th style="width: 150px;" class="text-center" scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php if(isset($resultSearch)) { ?>
            <?php if (count($resultSearch) == 0)
                echo "<tr>
                        <td colspan='7' class='text-center'> Không có thông tin bài viết trùng khớp </td>
                      </tr>" ?>
            <?php foreach ($resultSearch as $post) { ?>
                <tr>
                    <td class="text-center"><img src="/assets/images/postImage/<?= $post['photo'] ?>" class="img-thumbnail"
                            alt="..." style="width: 80px;"></td>
                    <td><?= $post['postName'] ?></td>
                    <td><?= $post['description'] ?></td>
                    <td class="text-center"><?= $post['categoryName'] ?></td>
                    <td class="text-center">
                        <?php
                        $uploadTime = new DateTime($post['uploadTime']);
                        $formattedDate = $uploadTime->format('H:i:s d/m/Y');
                        echo $formattedDate;
                        ?>
                    </td>
                    <td class="text-center">
                        <?php if ($post['status'] == 0) { ?>
                            <span style="padding: 8px; font-size: 16px" class="badge badge-secondary">Chưa duyệt</span>
                        <?php } else if ($post['status'] == 1) { ?>
                                <span style="padding: 8px; font-size: 16px" class="badge badge-success">Đã duyệt</span>
                        <?php } else { ?>
                                <span style="padding: 8px; font-size: 16px" class="badge badge-danger">Bị từ chối</span>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="<?= $post['status'] == 0 ? "d-flex " : "text-center " ?> justify-content-center">
                            <a <?= $post['status'] == 0 ? "" : "hidden" ?> type="button" class="btn btn-primary"
                                style="margin: 4px;" href="post/update/<?= $post['postId'] ?>"><i class="fa-solid fa-pencil"
                                    style="color: #fff;"></i></a>
                            <a type="button" class="btn btn-danger" style="margin: 4px;"
                                onclick="deletePost(<?=$post['postId']?>)"><i class="fa-solid fa-trash"
                                    style="color: #fff;"></i></a>
                        </div>
                    </td>
                </tr>

            <?php } ?>
            <?php }else{ ?>
                <?php foreach ($posts as $post) { ?>
                    <tr>
                        <td class="text-center"><img src="assets/images/postImage/<?= $post['photo'] ?>" class="img-thumbnail"
                                alt="..." style="width: 80px;"></td>
                        <td><?= $post['postName'] ?></td>
                        <td><?= $post['description'] ?></td>
                        <td class="text-center"><?= $post['categoryName'] ?></td>
                        <td class="text-center">
                            <?php
                            $uploadTime = new DateTime($post['uploadTime']);
                            $formattedDate = $uploadTime->format('H:i:s d/m/Y');
                            echo $formattedDate;
                            ?>
                        </td>
                        <td class="text-center">
                            <?php if ($post['status'] == 0) { ?>
                                <span style="padding: 8px; font-size: 16px" class="badge badge-secondary">Chưa duyệt</span>
                            <?php } else if ($post['status'] == 1) { ?>
                                    <span style="padding: 8px; font-size: 16px" class="badge badge-success">Đã duyệt</span>
                            <?php } else { ?>
                                    <span style="padding: 8px; font-size: 16px" class="badge badge-danger">Bị từ chối</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="<?= $post['status'] == 0 ? "d-flex " : "text-center " ?> justify-content-center">
                                <a <?= $post['status'] == 0 ? "" : "hidden" ?> type="button" class="btn btn-primary"
                                    style="margin: 4px;" href="post/update/<?= $post['postId'] ?>"><i class="fa-solid fa-pencil"
                                        style="color: #fff;"></i></a>
                                <a type="button" class="btn btn-danger" style="margin: 4px;"
                                    onclick="deletePost(<?=$post['postId']?>)"><i class="fa-solid fa-trash"
                                        style="color: #fff;"></i></a>
                            </div>
                        </td>
                    </tr>

                <?php } ?>
            <?php } ?>               

        </tbody>
    </table>
</div>

<script>
    function deletePost(postId) {
        if (confirm('Bạn có chắc muốn xóa bài viết này không?'))
            window.location.href = 'post/delete/' + postId;
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../templates/layout.php'); ?>