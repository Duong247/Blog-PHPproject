<?php ob_start(); ?>
<?php $action =0?>
<div class="container">
    <div class="d-flex justify-content-between">
        <h2 style="padding-bottom: 8px">Quản lý thể loại</h2>
        <button class="btn btn-success" style="display: inline-block;height: 40px;" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openCreateModal()" ><i class="fa-solid fa-plus"></i> Thêm loại</button>
    </div>

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
                <th class="text-center" scope="col">Thể loại</th>
                <th class="text-center" scope="col">Số lượng bài viết</th>
                <th class="text-center" scope="col"></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <th class="text-center" scope="col"><?=$category['categoryName']?></th>
                    <th class="text-center" scope="col"><?=$category['postCount']?></th>
                    <th>
                        <div class="text-center justify-content-between">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    onclick="openEditModal(<?= $category['categoryId'] ?>, '<?= $category['categoryName'] ?>')"
                                    >
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-danger" style="margin: 4px;" data-toggle="tooltip"
                                    data-placement="top" title="Xóa" onclick="deleteCategory(<?= $category['categoryId'] ?>)">
                                    <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </th>
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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="categoryForm" action="manageCategories/create" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tên loại:</label>
                    <input type="text" name="categoryName" class="form-control" id="categoryName" aria-describedby="emailHelp">
                </div>
                <input type="hidden" name="categoryId" id="categoryId">
                <div class="text-right">
                    <button id="submitbtn" type="submit" class="btn btn-success align-text-bottom" style="width: 80px;"><i class="fa-solid fa-plus"></i> Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    function deleteCategory(postId) {
        if (confirm('Bạn có chắc muốn xóa thể loại này?')) {
            window.location.href = 'manageCategories/delete/' + postId;
        }
    }

    function openEditModal(categoryId, categoryName) {
        document.getElementById('categoryId').value = categoryId;
        document.getElementById('categoryName').value = categoryName;
        document.getElementById('categoryForm').action = 'manageCategories/update/'+categoryId;
        document.querySelector('#exampleModalLabel').textContent = "Sửa thể loại";
        document.querySelector('#submitbtn').textContent = "Lưu";
    }

    function openCreateModal() {
        document.getElementById('categoryId').value = "";
        document.getElementById('categoryName').value = "";
        document.getElementById('categoryForm').action = 'manageCategories/create';
        document.querySelector('#exampleModalLabel').textContent = "Thêm thể loại";
        document.querySelector('#submitbtn').textContent = "Thêm";
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php
define('BASE_PATH', dirname(__DIR__, 2));
include(BASE_PATH . '/templates/layout.php');
?>