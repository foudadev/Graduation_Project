<?php

    require_once "../../Config.php";
    require_once "../../Functions/DBFunctions.php";
    require_once "../../Functions/HelperFunctions.php";

    // check if form submited
    if(isset($_POST['upload'])) {
        // files data
        $image_name = basename($_FILES["image"]["name"]);
        //upload files
        $image_status = UploadImage($conn, $image_name, "../../Assets/admin/uploaded_images/".$image_name);
        //check if files uploaded successfully
        if ($image_status == 1) {
            // insert in DB
            insert($conn, "playlists", [
                "title" => $_POST['title'],
                "description" => $_POST['description'],
                "background_image" => $image_name,
            ]);
            alert("Playlist Added Successfully", 1);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Upload-Video</title>

    <!-- Custom fonts for this template-->
    <link href="../../Assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../Assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Playlist!</h1>
                                    </div>
                                    <form class="user" action="add-playlist.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Playlist Tittle</label>
                                            <input type="text" name="title" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Video Title..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Video Description</label>
                                            <input type="text" name="description" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Video description..." required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Background Image</label>
                                            <input class="form-control" type="file" name="image" id="formFile" required>
                                          </div>
                                          <br>
                                         <br>
                                        <hr>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" name="upload" value="upload">
                                        <hr>

                                    </form>
                                    <br>
                                    <br>
                                    <br>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../Assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="../../Assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../Assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../Assets/admin/js/sb-admin-2.min.js"></script>

</body>

</html>