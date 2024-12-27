<?php ob_start(); ?>
<div class="container">
<div id="body">
  <div class="site-container">
    <div id="action">
      <div id="action_container">
        <button class="back_btn">Go Back</button>
        <button class="saveChange_btn">Save Changes</button>
      </div>
    </div>
    <div id="main_container" class="border_css">
      <div id="main_cover">
        <div id="main_head">
          <h1>Post</h1>
        </div>
        <div id="main_body">
          <form action="create" method="POST" enctype="multipart/form-data">
            <fieldset>
              <legend>Post Information</legend>
              <div class="row">
                <div class="col_50 form_input">
                  <label for="postName">Tiêu đề</label>
                  <input type="text" class="postName" id="postName" name="postName" >
                </div>
                <div class="col_25 form_input">
                  <!-- <label for="currentUser">currentUser</label> -->
                  <input type="text" hidden class="currentUser" id="currentUser" name="currentUser" >
                </div>
              </div>
              <div class="form_input">
                <label for="description">Mô tả</label>
                <textarea id="description" name="description" cols="30" rows="5" class="description"></textarea>
              </div>
              <div class="row">
                <div class="form_input">
                  <label for="categoryId">Thể loại</label>
                  <select id="category" name="categoryId" class="form-select">
                    <!-- <option value="">Giải phẫu</option> -->
                    <?php foreach($categories as $category){?>
                      <option value="<?=$category['categoryId']?>"><?=$category['categoryName']?></option>  
                    <?php }?>
                    <!-- Add more categories as needed -->
                  </select>
                </div>
                <div class="form_input">
                  <label for="upload_file">Upload file</label>
                  <div class="upload_file">
                    <input
                      type="file"
                      class="fileToUpload"
                      id="image"
                      name="fileToUpload"
                      accept="image/*"
                      onchange="readURL(this);"
                    >
                  </div>
                </div>
              </div>
              <div class="form_input">
                <label for="textarea_containner">Body:</label>
                <div id="textarea_containner">
                  <textarea class="textarea" id="body_text" name="content"></textarea>
                </div>
              </div>
              //TODO: truyen userId
              <button type="submit" id="save_btn">Save</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
tinymce.init({
    selector: '.textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' },
    ],
});

tinymce.init({
    selector: '.textarea',
    plugins: 'image',
    toolbar: 'image',
    images_upload_url: '/upload-image.php',
    images_upload_handler: function (blobInfo, success, failure) {
        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        fetch('/upload-image.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => success(data.location))
        .catch(error => failure('Image upload failed.'));
    }
});


document.getElementById('save_btn').addEventListener('click', function(event) {
    tinymce.triggerSave(); // Đồng bộ dữ liệu TinyMCE về <textarea>
    const formData = new FormData();
    formData.append('title', document.getElementById('title').value);
    formData.append('author', document.getElementById('author').value);
    formData.append('description', document.getElementById('description').value);
    formData.append('category', document.getElementById('category').value);
    formData.append('body', document.getElementById('body_text').value);
    formData.append('image', document.getElementById('image').files[0]);

    fetch('/save-post.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        alert('Post saved successfully!');
    })
    .catch(error => console.error('Error:', error));
});



</script>
<script src="vendor/jquery/jquery.min.js"></script  >
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Additional Scripts -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/isotope.js"></script>
<script src="assets/js/accordions.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script language = "text/Javascript"> 
  cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
  function clearField(t){                   //declaring the array outside of the
  if(! cleared[t.id]){                      // function makes it static and global
      cleared[t.id] = 1;  // you could use true and false, but that's more typing
      t.value='';         // with more chance of typos
      t.style.color='#fff';
      }
  }
  tinymce.activeEditor.setContent('<span>some</span> html');
</script>
</div>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../templates/layout.php'); ?>