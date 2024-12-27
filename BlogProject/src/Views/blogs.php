<?php ob_start(); ?>
<section class="blog-posts grid-system">
  <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <?php foreach($posts as $post){?>
                  <div class="col-lg-6">
                    <div class="blog-post">
                      <div class="blog-thumb">
                        <img src="/assets/images/postImage/<?=$post['photo']?>" alt="">
                      </div>
                      <div class="down-content">
                        <a href="postDetail/<?=$post['postId']?>"><h4><?=$post['postName']?></h4></a>
                        <ul class="post-info" style="padding: 0;">
                          <li><a href="#"><?=$post['first_name']?></a></li>
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
                            <div class="col-lg-12">
                              <ul class="post-tags" style="padding: 0;">
                                <li><i class="fa fa-tags"></i></li>
                                <li><a href="#"><?=$post['categoryName']?></a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <div class="col-lg-12">
                  <ul class="page-numbers">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                  </ul>
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
                <div class="col-lg-12">
                  <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                      <h2>Recent Posts</h2>
                    </div>
                    <div class="content">
                      <ul>
                      <?php foreach ($recentPosts as $recentPost):?>
                            <li>
                              <a href="postDetail/<?=$recentPost['postId']?>">
                                <h5><?=$recentPost['postName'] ?></h5>
                                <span><?php $uploadTime = new DateTime($recentPost['uploadTime']);
                                  echo $uploadTime->format('M d, Y'); ?>
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
                      <h2>Categories</h2>
                    </div>
                    <div class="content">
                      <ul>
                      <?php foreach ($categories as $category):?>
                          <li><a href="/blogs/<?=$category['categoryId'] ?>">- <?=$category['categoryName'] ?></a></li>
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
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../templates/layout.php'); ?>