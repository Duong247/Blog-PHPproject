<?php ob_start(); ?>
<div class="container">
    <h2 style="padding-bottom: 8px">Quản lý bài đăng</h2>
    <hr>
    <div class="input-group mb-3">
        <form class="d-flex w-100 justify-content-between" action="/managePosts/search" method="GET">
            <select style="width: 185px; outline: none; font-size: 18px" name="status" class="statusFilter text-center" id="status">
                <option value="" <?php if ($status === null)
                    echo 'selected'; ?>>-- Chọn trạng thái --</option>
                <option value="1" <?php if ($status === '1')
                    echo 'selected'; ?>>Đã duyệt</option>
                <option value="0" <?php if ($status === '0')
                    echo 'selected'; ?>>Chưa duyệt</option>
                <option value="-1" <?php if ($status === '-1')
                    echo 'selected'; ?>>Bị từ chối</option>
            </select>
            <div style="width: 85%" class="d-flex justify-content-center">
                <input style="border-radius: 0" type="text" class="form-control"
                    placeholder="Nhập tên bài viết cần tìm kiếm..." aria-label="" name="searchValue"
                    value="<?= htmlspecialchars($searchValue ?? '') ?>" aria-describedby="basic-addon1">
                <div class="input-group-prepend">
                    <button style="border-radius: 0" class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                </div>
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
            <?php foreach ($posts as $post) { ?>
                <tr>
                    <td class="text-center"><img
                            src="https://m.media-amazon.com/images/M/MV5BNjIyYjg4YWUtNTM2OS00YTc3LWE5NTEtZTdmMDdiMzE1OGJjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
                            class="img-thumbnail" alt="..." style="width: 80px;"></td>
                    <td><?= $post['postName'] ?></td>
                    <td><?= $post['description'] ?></td>
                    <td class="text-center"><?= $post['categoryName'] ?></td>
                    <td class="text-center"><?= $post['first_name'] . ' ' . $post['last_name'] ?></td>
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
                                onclick="previewPost(<?= $post['postId'] ?>, <?= $post['id'] ?>)">
                                <i style="color: #fff" class="fa-solid fa-eye"></i>
                                <?php if ($post['status'] == 0) { ?>
                                    <button type="button" class="btn btn-success" style="margin: 4px;" data-toggle="tooltip"
                                        data-placement="top" title="Duyệt bài viết"
                                        onclick="acceptPost(<?= $post['postId'] ?>)">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning" style="color: #FFF; margin: 4px;"
                                        data-toggle="tooltip" data-placement="top" title="Từ chối bài viết"
                                        onclick="declinePost(<?= $post['postId'] ?>)">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>
                                <?php } else if ($post['status'] == -1) { ?>
                                        <button type="button" class="btn btn-danger" style="margin: 4px;" data-toggle="tooltip"
                                            data-placement="top" title="Xóa bài viết" onclick="deletePost(<?= $post['postId'] ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                <?php } else { ?>
                                        <button type="button" class="btn btn-warning" style="color: #FFF; margin: 4px;"
                                            data-toggle="tooltip" data-placement="top" title="Từ chối bài viết"
                                            onclick="declinePost(<?= $post['postId'] ?>)">
                                            <i class="fa-solid fa-ban"></i>
                                        </button>
                                <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
</div>
<script>
    function previewPost(postId, userId) {
        window.location.href = '/managePosts/previewPost?postId=' + postId + '&userId=' + userId;
    }

    function acceptPost(postId) {
        if (confirm('Bạn có chắc muốn duyệt bài viết này?')) {
            window.location.href = '/acceptPost?postId=' + postId;
        }
    }

    function declinePost(postId) {
        if (confirm('Bạn có chắc muốn từ chối duyệt bài viết này?')) {
            window.location.href = '/declinePost?postId=' + postId;
        }
    }

    function deletePost(postId) {
        if (confirm('Bạn có chắc muốn xóa bài viết này?')) {
            window.location.href = '/deletePost?postId=' + postId;
        }
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php
define('BASE_PATH', dirname(__DIR__, 2));
include(BASE_PATH . '/templates/layout.php');
?>