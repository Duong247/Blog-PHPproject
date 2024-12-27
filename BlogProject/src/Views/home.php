<?php ob_start(); ?>

<!-- Page Content -->
<section class="blog-posts">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="all-blog-posts">
                    <div class="row">
                        <?php 
                foreach ($posts as $post):?>
                  <div class="col-lg-12">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="/templates/assets/images/<?=$post['photo'] ?>" alt="">
                      </div>
                      <div class="down-content">
                        <span><?=$post['categoryName'] ?></span>
                        <!-- <a href="postDetail.php"><h4><?=$post['postName']?></h4></a> -->
                        <a href="postDetail/<?=$post['postId']?>"><h4><?=$post['postName']?></h4></a>
                        <ul class="post-info">
                          <li><a href="#"><?=$post['last_name'] ?></a></li>
                          <li>
                            <a href="#"> 
                              <?php $uploadTime = new DateTime($post['uploadTime']);
                                    echo $uploadTime->format('M d, Y'); 
                              ?>
                            </a>
                          </li>
                          <li><a href="#"><?=$post['commentCount']?> Comments</a></li>
                        </ul>
                        <p><?=$post['description']?></p>
                        <div class="post-options">
                          <div class="row">
                            <div class="col-6">
                              <ul class="post-tags">
                                <li><i class="fa fa-tags"></i></li>
                                <li><a href="#">Beauty</a>,</li>
                                <li><a href="#">Nature</a></li>
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
              <?php endforeach; ?>
                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="blogs.php">View All Posts</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                      <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                    </form>
                  </div>
                </div>
                <!-- start recent post -->
                <div class="col-lg-12">
                  <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                      <h2>Recent Posts</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <?php 
                          foreach ($posts as $post):?>
                                        <li>
                                            <a href="postDetail/<?=$post['postId']?>">
                                                <h5><?=$post['postName'] ?></h5>
                                                <span><?php $uploadTime = new DateTime($post['uploadTime']);
                                  echo $uploadTime->format('M d, Y'); ?>
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
                      <h2>Categories</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <?php foreach ($categories as $category):?>
                          <li><a href="#">- <?=$category['categoryName'] ?></a></li>
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
define('BASE_PATH', dirname(__DIR__, 2  ));
include(BASE_PATH . '/templates/layout.php');
?>