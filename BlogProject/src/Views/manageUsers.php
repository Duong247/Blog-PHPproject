<?php ob_start(); ?>
<div class="container">
    <h2 style="padding-bottom: 8px">Quản lý người dùng</h2>

    <hr>

    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Nhập tên người dùng cần tìm kiếm..." aria-label=""
            aria-describedby="basic-addon1">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary" type="button">Tìm kiếm</button>
        </div>
    </div>

    <table style="background-color: #f5f5f5" class="table mt-3 table-bordered">
        <thead class="table-primary">
            <tr>
                <th class="text-center" scope="col">Họ và tên</th>
                <th class="text-center" scope="col">Email</th>
                <th class="text-center" scope="col">Thời gian tạo</th>
                <th style="width: 180px;" class="text-center" scope="col">Số bài viết đã đăng</th>
                <th class="text-center" scope="col">Vai trò</th>
                <th style="width: 150px;" class="text-center" scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 5; $i++) { ?>
                <tr>
                    <td>Dương ma tê</td>
                    <td>duongmate@gmail.com</td>
                    <td class="text-center">25/12/2024</td>
                    <td class="text-center">5</td>
                    <td class="text-center"><?php if ($i < 2)
                        echo "Admin";
                    else
                        echo "Người dùng"; ?></td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-info" style="margin: 0 4px;" data-toggle="tooltip"
                                data-placement="top" title="Xem các bài viết của người dùng"><i
                                    class="fa fa-navicon"></i></button>
                            <button type="button" class="btn btn-warning" style="margin: 0 4px;" data-toggle="tooltip"
                                data-placement="top" title="Chỉnh sửa người dùng"><i style="color: #fff"
                                    class="fa-solid fa-pencil"></i></button>
                            <button type="button" class="btn btn-danger" style="margin: 0 4px;" data-toggle="tooltip"
                                data-placement="top" title="Xóa người dùng"><i class="fa-solid fa-trash"></i></button>
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