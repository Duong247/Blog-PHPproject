<?php ob_start(); ?>

<!-- Page Content -->
<section class="blog-posts">
  <div style="margin-bottom: 48px" class="container">
    <div class="row">
      <div class="col-lg-8">
        <?php if (count($posts) != 0) { ?>
          <div class="all-blog-posts">
            <div class="row">
              <?php
              foreach ($posts as $post): ?>
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="assets/images/postImage/<?= $post['photo'] ?>" alt="">
                    </div>
                    <div class="down-content">
                      <a href="postDetail/<?= $post['postId'] ?>">
                        <h4><?= $post['postName'] ?></h4>
                      </a>
                      <ul class="post-info">
                        <li><a href="#"><?= $post['first_name'] . ' ' . $post['last_name'] ?></a></li>
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
                      <hr style="opacity: .1;">
                      <p><?= $post['description'] ?></p>
                      <hr style="opacity: .1;">
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="#"><?= $post['categoryName'] ?></a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
              <div class="col-lg-12">
                <div class="main-button">
                  <a href="blogs">Xem tất cả bài viết</a>
                </div>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div style="font-size: 16px; padding: 12px; color: rgba(0, 0, 0, 0.6)" class="text-center">
            Chưa có bài viết nào. <a style="color: #F48840" href="/createPost">Đăng bài viết</a>
          </div>
        <?php } ?>
      </div>
      <div class="col-lg-4">
        <div class="sidebar">
          <div class="row">
            <!-- start recent post -->
            <div class="col-lg-12">
              <div style="margin-top: 0" class="sidebar-item recent-posts">
                <div class="sidebar-heading">
                  <h2>Bài viết gần đây</h2>
                </div>
                <div class="content">
                  <ul>
                    <?php
                    foreach ($posts as $post): ?>
                      <li>
                        <a href="postDetail/<?= $post['postId'] ?>">
                          <h5><?= $post['postName'] ?></h5>
                          <span>
                            <?php
                            $uploadTime = new DateTime($post['uploadTime']);
                            $formattedDate = $uploadTime->format('H:i d/m/Y');
                            echo $post['first_name'] . ' ' . $post['last_name'] . ' | ' . $formattedDate;
                            ?>
                          </span>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            </div>
            <!-- end recent post -->
            <div class="col-lg-12">
              <div class="sidebar-item categories">
                <div class="sidebar-heading">
                  <h2>Thể loại</h2>
                </div>
                <div class="content">
                  <ul>
                    <?php foreach ($categories as $category): ?>
                      <li style="list-style: inside"><a
                          href="blogs/<?= $category['categoryId'] ?>"><?= $category['categoryName'] ?></a></li>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php $content = ob_get_clean(); ?>
<?php
define('BASE_PATH', dirname(__DIR__, 2));
include(BASE_PATH . '/templates/layout.php');
?>