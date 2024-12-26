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
                      <img src="/templates/assets/images/<?=$post['photo'] ?>" alt="ảnh">
                    </div>
                    <div class="down-content">
                      <span><?=$post['categoryName']?></span>
                      <a href="postDetail.php"><h4><?=$post['postName']?></h4></a>
                      <ul class="post-info">
                        <li><a href="#"><?=$post['last_name'].' '.$post['first_name']?></a></li>
                        <li>
                          <a href="#">
                            <?php $uploadTime = new DateTime($post['uploadTime']);
                              echo $uploadTime->format('M d, Y'); 
                            ?>
                          </a>
                        </li>
                        <li><a href="#"><?=$countComment['COUNT(*)'] ?> Comments</a></li>
                      </ul>
                      <p>
                      <?=$post['content']?>
                      </p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              <li><a href="#">Best Templates</a>,</li>
                              <li><a href="#">TemplateMo</a></li>
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
                      <h2><?=(int)$countComment['COUNT(*)']==0?"No":$countComment['COUNT(*)'] ?>  comments</h2>
                    </div>
                    <p class="text-center" <?=(int)$countComment['COUNT(*)']>0?"hidden":""?>>Chưa có bình luận nào</p>
                    <div class="content" <?=(int)$countComment['COUNT(*)']==0?"hidden":""?>  >
                      <ul>
                        <li>
                          <div class="author-thumb">
                            <img src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png" alt="">
                          </div>
                          <div class="right-content">
                            <h4>Charles Kate<span>May 16, 2020</span></h4>
                            <p>Fusce ornare mollis eros. Duis et diam vitae justo fringilla condimentum eu quis leo. Vestibulum id turpis porttitor sapien facilisis scelerisque. Curabitur a nisl eu lacus convallis eleifend posuere id tellus.</p>
                            <a href="#" class="replied-btn">Trả lời</a>
                          </div>
                        </li>
                        <li class="replied reply-form " >
                            <div class="content">
                                <form id="comment" class="reply-form" action="#" method="post">
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <fieldset>
                                        <textarea style="width: 100%;" name="message" rows="2" id="message" placeholder="Type your comment" required=""></textarea>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12">
                                        <fieldset>
                                        <button type="submit" id="form-submit" class="main-button reply-submit-btn">Đăng</button>
                                        </fieldset>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="replied">
                          <div class="author-thumb">
                            <img src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png" alt="">
                          </div>
                          <div class="right-content">
                            <h4>Thirteen Man<span>May 20, 2020</span></h4>
                            <p>In porta urna sed venenatis sollicitudin. Praesent urna sem, pulvinar vel mattis eget.</p>
                          </div>
                        </li>
                        <li>
                          <div class="author-thumb">
                            <img src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png" alt="">
                          </div>
                          <div class="right-content">
                            <h4>Belisimo Mama<span>May 16, 2020</span></h4>
                            <p>Nullam nec pharetra nibh. Cras tortor nulla, faucibus id tincidunt in, ultrices eget ligula. Sed vitae suscipit ligula. Vestibulum id turpis volutpat, lobortis turpis ac, molestie nibh.</p>
                            <a href="#" class="replied-btn">Trả lời</a>  
                         </div>
                        </li>
                        <li class="replied">
                          <div class="author-thumb">
                            <img src="https://e7.pngegg.com/pngimages/84/165/png-clipart-united-states-avatar-organization-information-user-avatar-service-computer-wallpaper-thumbnail.png" alt="">
                          </div>
                          <div class="right-content">
                            <h4>Thirteen Man<span>May 22, 2020</span></h4>
                            <p>Mauris sit amet justo vulputate, cursus massa congue, vestibulum odio. Aenean elit nunc, gravida in erat sit amet, feugiat viverra leo.</p>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                      <h2>Your comment</h2>
                    </div>
                    <div class="content">
                      <form id="comment" action="#" method="post">
                        <div class="row">
                          <div class="col-lg-12">
                            <fieldset>
                              <textarea name="message" rows="5" id="message" placeholder="Type your comment" required=""></textarea>
                            </fieldset>
                          </div>
                          <div class="col-lg-12">
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-button">Đăng</button>
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
                        <?php 
                            foreach ($postsRecents as $postRc):?>
                              <li>
                                <a href="/postDetail/<?=$postRc['postId']?>">
                                  <h5><?=$postRc['postName'] ?></h5>
                                  <span><?php $uploadTime = new DateTime($postRc['uploadTime']);
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


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../templates/layout.php'); ?>