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
          <fieldset>
            <legend>Post Information</legend>
            <div class="row">
              <div class="col_50 form_input">
                <label for="title">Title</label>
                <input type="text" class="title" id="title" name="title" >
              </div>
              <div class="col_25 form_input">
                <label for="author">Author</label>
                <input type="text" class="author" id="author" name="author" >
              </div>
            </div>
            <div class="form_input">
              <label for="description">Description</label>
              <textarea id="description" name="description" cols="30" rows="5" class="description"></textarea>
            </div>
            <div class="row">
              <div class="form_input">
                <label for="category">Category</label>
                <select id="category" name="category" class="form-select">
                  <option value="1">Giải phẫu</option>
                  <!-- Add more categories as needed -->
                </select>
              </div>
              <div class="form_input">
                <label for="upload_file">Upload file</label>
                <div class="upload_file">
                  <input
                    type="file"
                    class="file_input"
                    id="image"
                    name="image"
                    accept="image/*"
                    onchange="readURL(this);"
                  >
                </div>
              </div>
            </div>
            <div class="form_input">
              <label for="textarea_containner">Body:</label>
              <div id="textarea_containner">
                <textarea class="textarea" id="body_text" name="body"></textarea>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
      <button id="save_btn">Save</button>
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

</script>
<script src="vendor/jquery/jquery.min.js"></script>
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
</script>
</div>
<?php $content = ob_get_clean(); ?>
<?php include (__DIR__ . '/../../templates/layout.php'); ?>