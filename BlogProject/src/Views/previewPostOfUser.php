<!-- <img src="/assets/images/postImage/<?= $post['photo'] ?>" alt="ảnh"> -->
<?php ob_start(); ?>

<section class="blog-posts grid-system">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div style="padding: 0 0 12px 0" class="col-lg-12">
                    <a class="return_link" href="/manageUser?userId=<?=$user['id']?>">
                        <i class="fa-solid fa-angle-left"></i> Quay lại trang trước
                    </a>
                </div>
                <div class="all-blog-posts">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blog-post">
                                <div class="blog-thumb">
                                    <img src="/assets/images/postImage/<?= $post['photo'] ?>" alt="ảnh">
                                </div>
                                <div class="down-content">
                                    <h4><?= $post['postName'] ?></h4>
                                    <ul class="post-info">
                                        <li><a href="#"><?= $post['last_name'] . ' ' . $post['first_name'] ?></a></li>
                                        <li style="color: #AAAAAA">
                                            <?php
                                            $uploadTime = new DateTime($post['uploadTime']);
                                            $formattedDate = $uploadTime->format('H:i d/m/Y');
                                            echo $formattedDate;
                                            ?>
                                        </li>
                                        <li style="color: #AAAAAA"><?= $countComment['COUNT(*)'] ?> Bình luận</li>
                                    </ul>

                                    <?= $post['content'] ?>

                                    <div class="post-options">
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="post-tags">
                                                    <li><i class="fa fa-tags"></i></li>
                                                    <li><a href="#"><?= $post['categoryName'] ?></a></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="post-share">
                                                    <li><i class="fa fa-share-alt"></i></li>
                                                    <li><a href="#">Facebook</a>,</li>
                                                    <li><a href="#"> Twitter</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="row">
                        <div class="col-lg-12">
                            <div style="margin-top: 0" class="sidebar-item recent-posts">
                                <div class="sidebar-heading">
                                    <h2>Bài viết gần đây</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        <?php
                                        foreach ($postsRecents as $postRc): ?>
                                            <li>
                                                <a href="#">
                                                    <h5><?= $postRc['postName'] ?></h5>
                                                    <span>
                                                        <?php
                                                        $uploadTime = new DateTime($post['uploadTime']);
                                                        $formattedDate = $uploadTime->format('H:i d/m/Y');
                                                        echo $formattedDate;
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
                                    <h2 class="mb-3">Thể loại</h2>
                                </div>
                                <div class="content">
                                    <ul>
                                        <?php foreach ($categories as $category): ?>
                                            <li style="list-style: inside"><a
                                                    href="#"><?= $category['categoryName'] ?></a>
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


<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="social-icons">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Behance</a></li>
                    <li><a href="#">Linkedin</a></li>
                    <li><a href="#">Dribbble</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>Copyright 2020 Stand Blog Co.

                        | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Additional Scripts -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/isotope.js"></script>
<script src="assets/js/accordions.js"></script>


<script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) {                   //declaring the array outside of the
        if (!cleared[t.id]) {                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value = '';         // with more chance of typos
            t.style.color = '#fff';
        }
    }
</script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../templates/layout.php'); ?>