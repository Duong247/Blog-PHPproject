<?php ob_start(); ?>
<div class="container">
    <div style="display: flex; align-items: center">
        <a style="margin-right: 12px; font-size: 24px;" href="/manageUsers">
            <i style="color: #000" class="fa-solid fa-angle-left"></i>
        </a>
        <h2 style="margin: 0">Bài viết của người dùng <strong
                style="color: #F48840"><?= $user['first_name'] . ' ' . $user['last_name'] ?></strong></h2>
    </div>

    <hr>

    <div class="input-group mb-3">
        <form action="/manageUserPosts/search" method="GET">
            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
            <select name="status" class="statusFilter" id="status">
                <option value="" <?php if ($status === null)
                                        echo 'selected'; ?>>-- Chọn trạng thái --</option>
                <option value="1" <?php if ($status === '1')
                                        echo 'selected'; ?>>Đã duyệt</option>
                <option value="0" <?php if ($status === '0')
                                        echo 'selected'; ?>>Chưa duyệt</option>
                <option value="-1" <?php if ($status === '-1')
                                        echo 'selected'; ?>>Bị từ chối</option>
            </select>

            <input type="text" class="form-control" placeholder="Nhập tên bài viết cần tìm kiếm..." aria-label=""
                name="searchValue" value="<?= htmlspecialchars($searchValue ?? '') ?>" aria-describedby="basic-addon1">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
            </div>
        </form>
    </div>

    <table style="background-color: #f5f5f5" class="table mt-3 table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center" scope="col" style="width:100px">Hình ảnh</th>
                <th class="text-center" scope="col">Tên bài viết</th>
                <th style="width: 200px;" class="text-center" scope="col">Mô tả</th>
                <th style="width: 150px;" class="text-center" scope="col">Loại</th>
                <th style="width: 180px;" class="text-center" scope="col">Tác giả</th>
                <th style="width: 150px;" class="text-center" scope="col">Thời gian đăng</th>
                <th style="width: 120px;" class="text-center" scope="col">Trạng thái</th>
                <th style="width: 150px;" class="text-center" scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($posts) == 0)
                echo "<tr><td colspan='9' class='text-center'>Không có kết quả tìm kiếm</td></tr>" ?>
            <?php foreach ($posts as $post) { ?>
                <tr>
                    <td class="text-center"><img
                            src="https://m.media-amazon.com/images/M/MV5BNjIyYjg4YWUtNTM2OS00YTc3LWE5NTEtZTdmMDdiMzE1OGJjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
                            class="img-thumbnail" alt="..." style="width: 80px;"></td>
                    <td><?= $post['postName'] ?></td>
                    <td><?= $post['description'] ?></td>
                    <td class="text-center"><?= $post['categoryName'] ?></td>
                    <td class="text-center"><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
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
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-info" style="margin: 4px;" data-toggle="tooltip"
                                data-placement="top" title="Xem trước bài viết"
                                onclick="previewPost(<?= $post['postId'] ?>, <?= $user['id'] ?>)">
                                <i style="color: #fff" class="fa-solid fa-eye"></i>
                            </button>
                            <?php if ($post['status'] == 0) { ?>
                                <button type="button" class="btn btn-success" style="margin: 4px;" data-toggle="tooltip"
                                    data-placement="top" title="Duyệt bài viết"
                                    onclick="acceptPost(<?= $post['postId'] ?>, <?= $user['id'] ?>)">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button type="button" class="btn btn-warning" style="color: #FFF; margin: 4px;"
                                    data-toggle="tooltip" data-placement="top" title="Từ chối bài viết"
                                    onclick="declinePost(<?= $post['postId'] ?>, <?= $user['id'] ?>)">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                            <?php } else if ($post['status'] == -1) { ?>
                                <button type="button" class="btn btn-danger" style="margin: 4px;" data-toggle="tooltip"
                                    data-placement="top" title="Xóa bài viết"
                                    onclick="deletePost(<?= $post['postId'] ?>, <?= $user['id'] ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-warning" style="color: #FFF; margin: 4px;"
                                    data-toggle="tooltip" data-placement="top" title="Từ chối bài viết"
                                    onclick="declinePost(<?= $post['postId'] ?>, <?= $user['id'] ?>)">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- Pagination -->
    <!-- <?php if (count($posts) != 0) { ?>
        <nav style="display: flex; justify-content: center; color: #000; margin-top: 32px"
            aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a style="color: #000; padding: 12px" class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a style="color: #000; padding: 12px" class="page-link" href="#">1</a></li>
                <li class="page-item"><a style="color: #000; padding: 12px" class="page-link" href="#">2</a></li>
                <li class="page-item"><a style="color: #000; padding: 12px" class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a style="color: #000; padding: 12px" class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    <?php } ?> -->
</div>
<script>
    function previewPost(postId, userId) {
        window.location.href = '/manageUser/previewPost?postId=' + postId + '&userId=' + userId;
    }

    function acceptPost(postId, userId) {
        if (confirm('Bạn có chắc muốn duyệt bài viết này?')) {
            window.location.href = '/manageUser/acceptPost?postId=' + postId + '&userId=' + userId;
        }
    }

    function declinePost(postId, userId) {
        if (confirm('Bạn có chắc muốn từ chối duyệt bài viết này?')) {
            window.location.href = '/manageUser/declinePost?postId=' + postId + '&userId=' + userId;
        }
    }

    function deletePost(postId, userId) {
        if (confirm('Bạn có chắc muốn xóa bài viết này?')) {
            window.location.href = '/manageUser/deletePost?postId=' + postId + '&userId=' + userId;
        }
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php
define('BASE_PATH', dirname(__DIR__, 2));
include(BASE_PATH . '/templates/layout.php');
?>