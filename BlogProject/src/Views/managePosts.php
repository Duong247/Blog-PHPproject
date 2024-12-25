<?php ob_start(); ?>
<div class="container">
    <h2 style="padding-bottom: 8px">Quản lý bài đăng</h2>

    <hr>

    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nhập tên bài viết cần tìm kiếm..." aria-label=""
            aria-describedby="basic-addon1">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button">Tìm kiếm</button>
        </div>
    </div>

    <table style="background-color: #f5f5f5" class="table mt-3 table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center" scope="col" style="width:80px">Hình ảnh</th>
                <th class="text-center" scope="col">Tên bài viết</th>
                <th class="text-center" scope="col">Mô tả</th>
                <th class="text-center" scope="col">Loại</th>
                <th class="text-center" scope="col">Nội dung</th>
                <th class="text-center" scope="col">Tác giả</th>
                <th style="width: 150px;" class="text-center" scope="col">Thời gian đăng</th>
                <th style="width: 120px;" class="text-center" scope="col">Trạng thái</th>
                <th style="width: 100px;" class="text-center" scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr>
                    <td class="text-center"><img
                            src="https://m.media-amazon.com/images/M/MV5BNjIyYjg4YWUtNTM2OS00YTc3LWE5NTEtZTdmMDdiMzE1OGJjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg"
                            class="img-thumbnail" alt="..." style="width: 80px;"></td>
                    <td>Dương ma tê</td>
                    <td>Mô tả demo</td>
                    <td class="text-center">ITC</td>
                    <td>Những chú bé đần</td>
                    <td class="text-center">Minh Lại</td>
                    <td class="text-center">2024-12-17 23:35:31</td>
                    <td class="text-center">
                        <?php if ($i % 2 != 0) { ?>
                            <span style="padding: 8px; font-size: 16px" class="badge badge-secondary">Chưa duyệt</span>
                        <?php } else { ?>
                            <span style="padding: 8px; font-size: 16px" class="badge badge-success">Đã duyệt</span>
                        <?php } ?>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <?php if ($i % 2 != 0) { ?>
                                <button type="button" class="btn btn-success" style="margin: 1px;" data-toggle="tooltip"
                                    data-placement="top" title="Duyệt bài viết"><i class="fa-solid fa-check"></i></button>
                                <button type="button" class="btn btn-danger" style="margin: 1px;" data-toggle="tooltip"
                                    data-placement="top" title="Xóa bài viết"><i class="fa-solid fa-trash"></i></button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-danger" style="margin: 1px;" data-toggle="tooltip"
                                    data-placement="top" title="Xóa bài viết"><i class="fa-solid fa-trash"></i></button>
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
<?php $content = ob_get_clean(); ?>
<?php
define('BASE_PATH', dirname(__DIR__, 2));
include(BASE_PATH . '/templates/layout.php');
?>