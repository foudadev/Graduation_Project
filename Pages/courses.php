<?php

    session_start();
    require_once "../Config.php";
    require_once "../Functions/DBFunctions.php";
    $playlists = select($conn, "playlists", ['id', 'title', 'description', 'background_image']);

    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }

    if (!isset($_SESSION['email'])) {
        $_SESSION['login_message'] = 1;
        header('Location: login.php');
        exit();
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
                                            <li class="active" ><a href="../index.php">Home</a></li>
                                            <li><a href="courses.html">Courses</a></li>
                                            <li><a href="about.html">About</a></li>
                                            <!-- Button -->
                                            <?php if (!isset($_SESSION['email'])) { ?>
                                            <li class="button-header margin-left "><a href="register.php" class="btn">Join</a></li>
                                            <li class="button-header"><a href="login.php" class="btn btn3">Log in</a></li>
                                            <?php } else { ?>
                                                <li class="button-header">
                                            <form action="courses.php" method="POST">
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
                                    <h1 data-animation="bounceIn" data-delay="0.2s">Our courses</h1>
                                    <!-- breadcrumb Start-->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Services</a></li> 
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
        <!-- Courses area start -->
        <div class="courses-area section-padding40 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Our featured courses</h2>
                        </div>
                    </div>
                </div>
                <div class="courses-actives">
                    <?php
                     foreach($playlists as $playlist) {
                        $rating_sum =  0.0 ;
                        $playlist_rates = select($conn, "rating", ['rate'], "playlist_id = '".$playlist['id']."'");
                        if (!empty($playlist_rates)) {
                            // count users that rate lessons in this playlist
                            $user_rating_count = count($playlist_rates);
                            // sum every rate to get total 
                            for ($i=0; $i < $user_rating_count; $i++) {
                                $rating_sum = $rating_sum + $playlist_rates[$i]['rate'];
                            }
                           $playlist_rate_avg = $rating_sum / $user_rating_count; 
                    ?>

                    <!-- Single -->
                    <div class="properties pb-20">
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href=""><img src="../Assets/admin/uploaded_images/<?php echo $playlist['background_image'];?>" alt=""></a>
                            </div>
                            <div class="properties__caption">
                                <h3><a href="video.php?playlist_id=<?php echo $playlist['id'];?>"><?php echo $playlist['title'];?></a></h3>
                                <p><?php echo $playlist['description'];?></p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="restaurant-name">
                                        <div class="rating">
                                            <?php 
                                                if ($playlist_rate_avg >= 1) {
                                                    // intial varibles
                                                    $rating_integer_value = intval($playlist_rate_avg);
                                                    $rating_decimal_value = $playlist_rate_avg - $rating_integer_value;
                                                    // for every one intger in rating will display a star
                                                    for ($i = 1; $i <= $rating_integer_value; $i++) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    }
                                                    // check if rating equal 0.5 or more to display half star
                                                    if ($rating_decimal_value >= 0.5) {
                                                        echo '<i class="fas fa-star-half"></i>';
                                                    }
                                                 }
                                            ?>
                                        </div>
                                        <p><span><?php echo($playlist_rate_avg)?></span> based on <?php echo $user_rating_count;?> Users</p>
                                    </div>
                                    <div class="price">
                                        <span>Free</span>
                                    </div>
                                </div>
                                <a href="video.php?playlist_id=<?php echo $playlist['id'];?>" class="border-btn border-btn2">Find out more</a>
                            </div>

                        </div>
                    </div>
                    <!-- Single -->
                    <?php } } ?>
                </div>
            </div>
        </div>
        <!-- Courses area End -->
        <!-- ? services-area -->
        <div class="services-area services-area2 section-padding40">
            <div class="container">
                <div class="row justify-content-sm-center">
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="../Assets/img/icon/icon1.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>60+ UX courses</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="../Assets/img/icon/icon2.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Expert instructors</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-8">
                        <div class="single-services mb-30">
                            <div class="features-icon">
                                <img src="../Assets/img/icon/icon3.svg" alt="">
                            </div>
                            <div class="features-caption">
                                <h3>Life time access</h3>
                                <p>The automated process all your website tasks.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
                                      Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">1337 Team</a>
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
    <script src="./../Assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./../Assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./../Assets/js/popper.min.js"></script>
    <script src="./../Assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./../Assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./../Assets/js/owl.carousel.min.js"></script>
    <script src="./../Assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./../Assets/js/wow.min.js"></script>
    <script src="./../Assets/js/animated.headline.js"></script>
    <script src="./../Assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./../Assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./../Assets/js/jquery.nice-select.min.js"></script>
    <script src="./../Assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./../Assets/js/jquery.barfiller.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="./../Assets/js/jquery.counterup.min.js"></script>
    <script src="./../Assets/js/waypoints.min.js"></script>
    <script src="./../Assets/js/jquery.countdown.min.js"></script>
    <script src="./../Assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./../Assets/js/contact.js"></script>
    <script src="./../Assets/js/jquery.form.js"></script>
    <script src="./../Assets/js/jquery.validate.min.js"></script>
    <script src="./../Assets/js/mail-script.js"></script>
    <script src="./../Assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./../Assets/js/plugins.js"></script>
    <script src="./../Assets/js/main.js"></script>
    
</body>
</html>