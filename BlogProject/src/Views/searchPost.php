<?php ob_start(); ?>
<section class="blog-posts grid-system">
    <div class="container">
        <div style="font-weight: 500; font-size: 24px;">
            Kết quả tìm kiếm cho từ khoá
            <?php echo "<strong style='color: #F48840'>'" . htmlspecialchars($searchValue) . "'</strong>" ?>
        </div>
        <hr style="opacity: .1">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php if (!empty($posts)) { ?>
                            <?php foreach ($posts as $post) { ?>
                                <div class="col-lg-6">
                                    <div class="blog-post">
                                        <div class="blog-thumb">
                                            <img src="/assets/images/postImage/<?= $post['photo'] ?>" alt="">
                                        </div>
                                        <div class="down-content">
                                            <a href="postDetail/<?= $post['postId'] ?>">
                                                <h4><?= $post['postName'] ?></h4>
                                            </a>
                                            <ul class="post-info" style="padding: 0;">
                                                <li><a href="#"><?= $post['first_name'] . ' ' . $post['last_name']?></a></li>
                                                <li>
                                                    <a href="#">
                                                        <?php
                                                        $uploadTime = new DateTime($post['uploadTime']);
                                                        $formattedDate = $uploadTime->format('H:i d/m/Y');
                                                        echo $formattedDate;
                                                        ?>
                                                    </a>
                                                </li>
                                                <li><a href="#"><?= $post['commentCount'] ?> Bình luận</a></li>
                                            </ul>
                                            <p><?= $post['description'] ?></p>
                                            <div class="post-options">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <ul class="post-tags" style="padding: 0;">
                                                            <li><i class="fa fa-tags"></i></li>
                                                            <li><a href="#"><?= $post['categoryName'] ?></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="col-lg-12 text-center">
                                <p>Không tìm thấy bài viết nào phù hợp với từ khóa '<?= htmlspecialchars($searchValue) ?>'
                                </p>
                            </div>
                        <?php } ?>
                        <!-- Pagination -->
                        <!-- <div class="col-lg-12">
                            <ul class="page-numbers">
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="row">
                        <div style="padding: 0" class="col-lg-12">
                            <div class="sidebar-item search">
                                <form id="search_form" method="GET" action="/blogs/search-posts">
                                    <input type="text" name="searchValue" class="searchText" placeholder="Tìm kiếm"
                                        value="<?= htmlspecialchars($searchValue) ?>" autocomplete="on">

                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item recent-posts">
                                <div class="sidebar-heading">
                                    <h2>Bài viết gần đây</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        <?php foreach ($recentPosts as $recentPost): ?>
                                            <li>
                                                <a href="postDetail/<?= $recentPost['postId'] ?>">
                                                    <h5><?= $recentPost['postName'] ?></h5>
                                                    <span>
                                                        <?php
                                                        $uploadTime = new DateTime($recentPost['uploadTime']);
                                                        $formattedDate = $uploadTime->format('H:i d/m/Y');
                                                        echo $recentPost['first_name'] . ' ' . $recentPost['last_name'] . ' | ' . $formattedDate;
                                                        ?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="sidebar-item categories">
                                <div class="sidebar-heading">
                                    <h2>Thể loại</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        <?php foreach ($categories as $category): ?>
                                            <li style="list-style: inside">
                                                <a href="/blogs/<?= $category['categoryId'] ?>"><?= $category['categoryName'] ?></a>
                                            </li>
                                        <?php endforeach; ?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // Lắng nghe sự kiện nhấn phím Enter
    document.getElementById("search_form").addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Ngăn chặn hành vi mặc định
            this.submit(); // Gửi form qua JavaScript
        }
    });
</script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../templates/layout.php'); ?>