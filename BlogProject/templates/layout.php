<!-- /templates/layout.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/rpod9wfgzb71njjy5apouixjrbfqwbp7ub7n16j1kx1sbi3p/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="stylesheet" href="../../templates/assets/css/createPost.css">
    <link rel="stylesheet" href="../../templates/assets/css/owl.css">
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/rpod9wfgzb71njjy5apouixjrbfqwbp7ub7n16j1kx1sbi3p/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <title>Create Post</title>
    <!-- Bootstrap core CSS -->
    <link href="../../templates/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.tiny.cloud/1/gi0p1ajd75o5n26qi8ujdhvgxcvvuyyo3yvuu3atelj6oy62/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="https://kit.fontawesome.com/3ecdd9878f.js" crossorigin="anonymous"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../../templates/assets/css/createPost.css">
    <link rel="stylesheet" href="../../templates/assets/css/templatemo-stand-blog.css" />
    <link rel="stylesheet" href="../../templates/assets/css/owl.css">

</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <h2>ITC Blog<em>.</em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="about.html">About Us</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="blog.html">Blog Entries</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="post-details.html">Post Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <div class="btn-group">
                                <a href="#" class="dropdown-toggle avatar" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img class="image-avatar"
                                        src="https://gratisography.com/wp-content/uploads/2024/11/gratisography-augmented-reality-800x525.jpg"
                                        alt="Avatar">
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" style="margin-top: 5px;">
                                    <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>


                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="page-heading">
        <?= $content ?>
    </div>

    <!-- Include Bootstrap JS and Popper.js via CDN (required for Bootstrap JavaScript features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>