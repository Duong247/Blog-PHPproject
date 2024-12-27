<!-- <img src="/assets/images/postImage/<?=$post['photo'] ?>" alt="ảnh"> -->
<?php ob_start(); ?>

<section class="blog-posts grid-system">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="all-blog-posts">
          <div class="row">
            <div class="col-lg-12">
              <div class="blog-post">
                <div class="blog-thumb">
                  <img src="/templates/assets/images/<?= $post['photo'] ?>" alt="ảnh">
                </div>
                <div class="down-content">
                  <a href="postDetail.php">
                    <h4><?= $post['postName'] ?></h4>
                  </a>
                  <ul class="post-info">
                    <li><a href="#"><?= $post['last_name'] . ' ' . $post['first_name'] ?></a></li>
                    <li>
                      <a href="#">
                        <?php
                        $uploadTime = new DateTime($post['uploadTime']);
                        $formattedDate = $uploadTime->format('H:i d/m/Y');
                        echo $formattedDate;
                        ?>
                      </a>
                    </li>
                    <li><a href="#"><?= $countComment['COUNT(*)'] ?> Bình luận</a></li>
                  </ul>
                  <p>
                    <?= $post['content'] ?>
                  </p>
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
            <div class="col-lg-12">
              <div class="sidebar-item comments">
                <div class="sidebar-heading">
                  <h2><?= (int) $countComment['COUNT(*)'] == 0 ? "0" : $countComment['COUNT(*)'] ?> bình luận</h2>
                </div>
                <p class="text-center" <?= (int) $countComment['COUNT(*)'] > 0 ? "hidden" : "" ?>>Chưa có bình luận nào
                </p>
                <div class="content" <?= (int) $countComment['COUNT(*)'] == 0 ? "hidden" : "" ?>>
                  <ul>
                    <?php foreach ($dataComments as $comment): ?>
                      <li style="width: 100%;">
                        <ul>
                          <li style="width: 100%; position: relative" id="cmt<?= $comment['mainComment']['commentId'] ?>">
                            <div class="author-thumb">
                              <img
                                src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png"
                                alt="">
                            </div>
                            <div class="right-content">
                              <h4>
                                <?= $comment['mainComment']['first_name'] . ' ' . $comment['mainComment']['last_name'] ?>
                                <span>
                                  <?php
                                  $uploadTime = new DateTime($comment['mainComment']['commentTime']);

                                  $formattedDate = $uploadTime->format('d/m/Y');
                                  $dayOfWeek = $uploadTime->format('l');

                                  $daysInVietnamese = [
                                    'Sunday' => 'Chủ nhật',
                                    'Monday' => 'Thứ hai',
                                    'Tuesday' => 'Thứ ba',
                                    'Wednesday' => 'Thứ tư',
                                    'Thursday' => 'Thứ năm',
                                    'Friday' => 'Thứ sáu',
                                    'Saturday' => 'Thứ bảy'
                                  ];

                                  $dayInVietnamese = $daysInVietnamese[$uploadTime->format('l')];

                                  echo "$dayInVietnamese, $formattedDate lúc " . $uploadTime->format('H:i');
                                  ?>
                                </span>
                              </h4>
                              <p><?= $comment['mainComment']['commentContent'] ?></p>
                              <?php
                              $currentUserId = 4; // TODO: Thay bằng userId lấy từ session
                              if ($currentUserId == $post['userId'] || $currentUserId == $comment['mainComment']['userId'] || $user['role'] == 1) {
                                ?>
                                <button class="btn delete-btn"
                                  onclick="deleteComment(<?= $post['postId'] ?>, <?= $comment['mainComment']['commentId'] ?>)">
                                  <i class="fa fa-times"></i>
                                </button>
                              <?php } ?>
                            </div>
                          </li>
                          <?php foreach ($comment['subComments'] as $subComment) { ?>
                            <li style="position: relative" id="cmt<?= $subComment['commentId'] ?>" class="replied">
                              <div class="author-thumb">
                                <img
                                  src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png"
                                  alt="">
                              </div>
                              <div class="right-content">
                                <h4><?= $subComment['first_name'] . ' ' . $subComment['last_name'] ?>
                                  <span><?php
                                  $uploadTime = new DateTime($subComment['commentTime']);

                                  $formattedDate = $uploadTime->format('d/m/Y');
                                  $dayOfWeek = $uploadTime->format('l');

                                  $daysInVietnamese = [
                                    'Sunday' => 'Chủ nhật',
                                    'Monday' => 'Thứ hai',
                                    'Tuesday' => 'Thứ ba',
                                    'Wednesday' => 'Thứ tư',
                                    'Thursday' => 'Thứ năm',
                                    'Friday' => 'Thứ sáu',
                                    'Saturday' => 'Thứ bảy'
                                  ];

                                  $dayInVietnamese = $daysInVietnamese[$uploadTime->format('l')];

                                  echo "$dayInVietnamese, $formattedDate lúc " . $uploadTime->format('H:i');
                                  ?>
                                  </span>
                                </h4>
                                <p><?= $subComment['commentContent'] ?></p>
                                <?php
                                if ($currentUserId == $post['userId'] || $currentUserId == $subComment['userId'] || $user['role'] == 1) {
                                  ?>
                                  <button class="btn delete-btn"
                                    onclick="deleteComment(<?= $post['postId'] ?>,<?= $subComment['commentId'] ?>)">
                                    <i class="fa fa-times"></i>
                                  </button>
                                <?php } ?>
                              </div>
                            </li>
                          <?php } ?>
                          <li class="replied reply-form">
                            <div class="content">
                              <form id="comment" class="reply-form" action="/postDetail/<?= $post['postId'] ?>/create"
                                method="POST">
                                <div class="row">
                                  <input name="commentId" type="hidden"
                                    value="<?= $comment['mainComment']['commentId'] ?>" />
                                  <input name="postId" type="hidden" value="<?= $post['postId'] ?>" />
                                  <div class="col-lg-12">
                                    <fieldset>
                                      <textarea style="width: 100%; padding: 8px;" name="message" rows="2" id="message"
                                        placeholder="Trả lời <?= $comment['mainComment']['first_name'] . ' ' . $comment['mainComment']['last_name'] ?>"
                                        required></textarea>
                                    </fieldset>
                                  </div>
                                  <div class="col-lg-12">
                                    <fieldset>
                                      <button style="width: 80px; border-radius: 0; margin-top: 4px" type="submit" id="form-submit"
                                        class="main-button reply-submit-btn">Đăng</button>
                                    </fieldset>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </li>
                        </ul>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="sidebar-item submit-comment">
                <div class="sidebar-heading">
                  <h2>Bình luận</h2>
                </div>
                <div class="content">
                  <form id="comment" action="/postDetail/<?= $post['postId'] ?>/create" method="POST">
                    <input name="postId" type="hidden" value="<?= $post['postId'] ?>" />
                    <div class="row">
                      <div class="col-lg-12">
                        <fieldset>
                          <textarea name="message" rows="5" id="message" placeholder="Nhập bình luận của bạn"
                            required=""></textarea>
                        </fieldset>
                      </div>
                      <div class="col-lg-12">
                        <fieldset>
                          <button style="width: 80px; border-radius: 0;" type="submit" id="form-submit" class="main-button">Đăng</button>
                        </fieldset>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="sidebar">
          <div class="row">
            <div style="padding: 0" class="col-lg-12">
              <div class="sidebar-item search">
                <form id="search_form" name="gs" method="GET" action="#">
                  <input type="text" name="q" class="searchText" placeholder="Nhập để tìm kiếm..." autocomplete="on">
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
                    <?php
                    foreach ($postsRecents as $postRc): ?>
                      <li>
                        <a href="/postDetail/<?= $postRc['postId'] ?>">
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
                      <li style="list-style: inside"><a href="#"><?= $category['categoryName'] ?></a></li>
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

<script>
  function deleteComment(postId, commentId) {
    if (confirm("Bạn có chắc muốn xóa bình luận này?")) {
      window.location.href = '/deleteComment?postId=' + postId + '&commentId=' + commentId;
    }
  }
</script>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../templates/layout.php'); ?>