<?php ob_start(); ?>
<div class="container">
    <h2>Quản lý bài đăng</h2>


    <table class="table mt-3 table-bordered">
        <thead>
            <tr>
            <th scope="col" style="width:80px">#</th>
            <th scope="col">Tên bài viết</th>
            <th scope="col">Thể loại</th>
            <th scope="col">Ảnh</th>
            <th scope="col">Thời điểm đăng</th>
            <th scope="col">Trạng thái</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td class="text-center"><img src="https://m.media-amazon.com/images/M/MV5BNjIyYjg4YWUtNTM2OS00YTc3LWE5NTEtZTdmMDdiMzE1OGJjXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg" class="img-thumbnail" alt="..." style="width: 80px;"></td>
            <td>@mdo</td>
            <td>@mdo</td>
            <td style="width: 80px;">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" style="margin: 1px;"><i class="fa-solid fa-pencil"></i></button>
                    <button type="button" class="btn btn-danger" style="margin: 1px;"><i class="fa-solid fa-trash"></i></button>
                </div>
            </td>

            </tr>
            
        </tbody>
    </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../templates/layout.php'); ?>