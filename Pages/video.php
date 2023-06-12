<?php
    session_start();
    require_once "../Config.php";
    require_once "../Functions/DBFunctions.php";
    
    if (!isset($_SESSION['email'])) {
        $_SESSION['login_message'] = 1;
        header('Location: login.php');
        exit();
    }

    // get play list id to get all videos in this playlist
     $playlist_id = $_GET['playlist_id'];
     $playlist_videos = select($conn, "videos", ['id', 'title', 'description', 'background_image', 'video'], "playlist_id = $playlist_id");

     if (!isset($_GET['video_id'])) {
       $video_id = $playlist_videos[0]['id'];
       $main_video = $playlist_videos[0]['video'];
       $main_video_title = $playlist_videos[0]['title'];
     } else {
       $video_id = $_GET['video_id'] ;
       $video = select($conn, "videos", ['video', 'title'], "id = $video_id");
       $main_video = $video[0]['video'];
       $main_video_title = $video[0]['title'];
     }

     // get user id
     $user_id = select($conn, "users", ['id'], "email = '".$_SESSION['email']."'")[0]['id']; 

     if (isset($_POST['submit_review'])) {
         if ($_POST['star'] !== null) {
             insert($conn, "rating", [
                 'rate' => $_POST['star'],
                 'comment' => $_POST['review'],
                 'user_id' => $user_id,
                 'video_id' => $video_id,
                 'playlist_id' => $playlist_id
             ]);
         }
     }

?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Courses | Education</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../Assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Assets/css/video-custom.css">
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../Assets/css/slicknav.css">
    <link rel="stylesheet" href="../Assets/css/flaticon.css">
    <link rel="stylesheet" href="../Assets/css/progressbar_barfiller.css">
    <link rel="stylesheet" href="../Assets/css/gijgo.css">
    <link rel="stylesheet" href="../Assets/css/animate.min.css">
    <link rel="stylesheet" href="../Assets/css/animated-headline.css">
    <link rel="stylesheet" href="../Assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../Assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../Assets/css/themify-icons.css">
    <link rel="stylesheet" href="../Assets/css/slick.css">
    <link rel="stylesheet" href="../Assets/css/nice-select.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
</head>

<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../Assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <!-- Header Start -->
    <div class="header-area header-transparent">
        <div class="main-header ">
            <div class="header-bottom  header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                                <a href="index.html"><img src="../Assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10">
                            <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">                                                                                          
                                            <li class="active"><a href="../index.php">Home</a></li>
                                            <li><a href="courses.html">Courses</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <!-- Button -->
                                            <?php if (!isset($_SESSION['email'])) { ?>
                                            <li class="button-header margin-left "><a href="Pages/register.php" class="btn">Join</a></li>
                                            <li class="button-header"><a href="Pages/login.php" class="btn btn3">Log in</a></li>
                                            <?php } else { ?>
                                                <li class="button-header">
                                            <form action="index.php" method="POST">
                                                    <button name="logout" value="logout" class="btn btn3">Log Out </button>
                                            </form>
                                                <?php } ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div> 
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <main>
        <!--? slider Area Start-->
        <section class="slider-area slider-area2">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8 col-lg-11 col-md-12">
                                <div class="hero__caption hero__caption2">
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Learn speak</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><h2><a href="index.html"><?php echo $main_video_title?></a></h2></li>
                                        </ol>
                                    </nav>
                                    <!-- breadcrumb End -->
                                </div>
                            </div>
                        </div>
                    </div>          
                </div>
            </div>
        </section>
    <div class="services-area services-area2 section-padding40 bg-dark">

    <div class="vid-main-wrapper clearfix">

    <!-- THE Video PLAYER -->
    <div class="vid-container">
    <video id="vid_frame" frameborder="0" width="1000" height="400" controls>
    <source src="../Assets/admin/uploaded_videos/<?php echo $main_video;?>" type="video/mp4"> </source>
    </video>
    </div>

    <!-- THE PLAYLIST -->
    <div class="vid-list-container">
    <ol id="vid-list">
        <?php foreach ($playlist_videos as $video) { ?>
    <li>
    <a href="?playlist_id=<?php echo $playlist_id; ?>&video_id=<?php echo $video['id']?>" onClick="document.getElementById('vid_frame').src='../Assets/admin/uploaded_videos/<?php echo $video['video'];?>'">
        <span class="vid-thumb"><img width=72 src="../Assets/admin/uploaded_images/<?php echo $video['background_image'];?>" /></span>
        <div class="desc"><?php echo $video['title'];?></div>
    </a>
    </li>
    <?php } ?>
  </ul>
 </div>
</div>
</div>
</main>

<hr>

<div class="cont">
<div class="stars">
<form action="video.php?playlist_id=<?php echo $playlist_id; ?>&video_id=<?php echo $video_id?>#review"  id="review" method="POST">
  <input class="star star-5" id="star-5-2" type="radio"  name="star" value="5"/>
  <label class="star star-5" for="star-5-2"></label>
  <input class="star star-4" id="star-4-2" type="radio" name="star" value="4"/>
  <label class="star star-4" for="star-4-2"></label>
  <input class="star star-3" id="star-3-2" type="radio" name="star" value="3"/>
  <label class="star star-3" for="star-3-2"></label>
  <input class="star star-2" id="star-2-2" type="radio" name="star" value="2"/>
  <label class="star star-2" for="star-2-2"></label>
  <input class="star star-1" id="star-1-2" type="radio" name="star" value="1"/>
  <label class="star star-1" for="star-1-2"></label>
  <div class="rev-box">
    <textarea placeholder="write you review ...." class="review" col="30" name="review"></textarea>
    <input type="submit" class="review btn-dark" name="submit_review" >
  </div>
</form>
</div>
</div>

<hr>

<!-- Carousel wrapper -->
<div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">

  <!-- Inner -->
  <div class="carousel-inner py-4">
    <!-- Single item -->
    <div class="carousel-item active">
      <div class="container">
        <div class="row">
          <?php 
            $recent_reviews = select($conn, "rating", ['rate', 'comment'], "video_id = $video_id ", null, 3);
            foreach ($recent_reviews as $review) {
          ?>
          <div class="col-lg-4">
            <img class="rounded-circle shadow-1-strong mb-4"
              src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp" alt="avatar"
              style="width: 150px;" />
            <p>3 PR Student </p>
            <p class="text-muted">
              <i class="fas fa-quote-left pe-2"></i>
              <?php echo $review['comment'];?>
            </p>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <?php 
                $rating_integer_value = intval($review['rate']);
                $rating_decimal_value = $review['rate'] - $rating_integer_value;
                 // for every one intger in rating will display a star
                for ($i = 1; $i <= $review['rate']; $i++) {
                    echo '<i class="fas fa-star"></i>';
                }
                // check if rating equal 0.5 or more to display half star
                if ($rating_decimal_value >= 0.5) {
                    echo '<li><i class="fas fa-star-half"></i></li>';
                }
               ?>
            </ul>
          </div>
    <?php } ?>
        </div>
      </div>
    </div>

        </div>
    </div>
    </div>

 </div>
</div>
</div>
</div>
  <!-- Inner -->
</div>
<!-- Carousel wrapper -->

<br>
    <footer>
     <div class="footer-wrappper footer-bg">
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-5 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo mb-25">
                                    <a href="index.html"><img src="../Assets/img/logo/logo2_footer.png" alt=""></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>The automated process starts as soon as your clothes go into the machine.</p>
                                    </div>
                                </div>
                                <!-- social -->
                                <div class="footer-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Our solutions</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Support</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Company</h4>
                                <ul>
                                    <li><a href="#">Design & creatives</a></li>
                                    <li><a href="#">Telecommunication</a></li>
                                    <li><a href="#">Restaurant</a></li>
                                    <li><a href="#">Programing</a></li>
                                    <li><a href="#">Architecture</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Footer End-->
      </div>
  </footer> 
  <!-- Scroll Up -->
  <div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->
<script src="../Assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="../Assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="../Assets/js/popper.min.js"></script>
<script src="../Assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="../Assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="../Assets/js/owl.carousel.min.js"></script>
<script src="../Assets/js/slick.min.js"></script>
<!-- One Page, Animated-HeadLin -->
<script src="../Assets/js/wow.min.js"></script>
<script src="../Assets/js/animated.headline.js"></script>
<script src="../Assets/js/jquery.magnific-popup.js"></script>

<!-- Date Picker -->
<script src="../Assets/js/gijgo.min.js"></script>
<!-- Nice-select, sticky -->
<script src="../Assets/js/jquery.nice-select.min.js"></script>
<script src="../Assets/js/jquery.sticky.js"></script>
<!-- Progress -->
<script src="../Assets/js/jquery.barfiller.js"></script>

<!-- counter , waypoint,Hover Direction -->
<script src="../Assets/js/jquery.counterup.min.js"></script>
<script src="../Assets/js/waypoints.min.js"></script>
<script src="../Assets/js/jquery.countdown.min.js"></script>
<script src="../Assets/js/hover-direction-snake.min.js"></script>

<!-- contact js -->
<script src="../Assets/js/contact.js"></script>
<script src="../Assets/js/jquery.form.js"></script>
<script src="../Assets/js/jquery.validate.min.js"></script>
<script src="../Assets/js/mail-script.js"></script>
<script src="../Assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->	
<script src="../Assets/js/plugins.js"></script>
<script src="../Assets/js/main.js"></script>

<script src="../Assets/js/video.js"></script>

</body>
</html>