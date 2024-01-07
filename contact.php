<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> KLL - Kolehiyo ng Lungsod ng Lipa</title>

    <link rel="stylesheet" type="text/css" href="home-assets/css/vendor.css">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="images/login/logo-kll.jpg" type="image/x-icon">
    <!-- Link Bootstrap's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="home-assets/style.css">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- script ================================================== -->
    <script src="home-assets/js/modernizr.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example2" tabindex="0">

    <!-- nav bar start  -->
    <header id="nav" class="site-header position-fixed text-white bg-dark">
        <nav id="navbar-example2" class="navbar navbar-expand-lg py-2">

            <div class="container ">

                <a data-aos="fade-right" data-aos-duration="2000" class="navbar-brand" href="home.php"><img style="height: 65px;" src="home-assets/images/homepage-kll-logo.png" alt="image"></a>

                <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation"><ion-icon name="menu-outline" style="font-size: 30px;"></ion-icon></button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div data-aos="fade-left" data-aos-duration="2000" class="offcanvas-body">
                        <ul class="navbar-nav align-items-center justify-content-end align-items-center flex-grow-1 ">
                            <li class="nav-item">
                                <a class="nav-link me-md-4" href="home.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-md-4" href="#about-us">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link me-md-4" href="#residence">Events</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active me-md-4" href="#help">Contact</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn-medium btn btn-info text-white" href="login.php">Student portal</a>
                            </li>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tabs-listing mt-4">
                                                <nav>
                                                    <div class="nav nav-tabs d-flex justify-content-center border-0" id="nav-tab2" role="tablist">
                                                        <button class="btn btn-outline-primary text-uppercase me-4 " id="nav-sign-in-tab2" data-bs-toggle="tab" data-bs-target="#nav-sign-in2" type="button" role="tab" aria-controls="nav-sign-in2" aria-selected="false">Log In</button>
                                                        <button class="btn btn-outline-primary text-uppercase active" id="nav-register-tab2" data-bs-toggle="tab" data-bs-target="#nav-register2" type="button" role="tab" aria-controls="nav-register2" aria-selected="true">Sign Up</button>
                                                    </div>
                                                </nav>
                                                <div class="tab-content" id="nav-tabContent1">
                                                    <div class="tab-pane fade " id="nav-sign-in2" role="tabpanel" aria-labelledby="nav-sign-in-tab2">
                                                        <form id="form3" class="form-group flex-wrap p-3 ">
                                                            <div class="form-input col-lg-12 my-4">
                                                                <label for="exampleInputEmail3" class="form-label fs-6 text-uppercase fw-bold text-black">Email
                                                                    Address</label>
                                                                <input type="text" id="exampleInputEmail3" name="email" placeholder="Email" class="form-control ps-3">
                                                            </div>
                                                            <div class="form-input col-lg-12 my-4">
                                                                <label for="inputPassword3" class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                                                                <input type="password" id="inputPassword3" placeholder="Password" class="form-control ps-3" aria-describedby="passwordHelpBlock">
                                                                <div id="passwordHelpBlock2" class="form-text text-center">
                                                                    <a href="#" class=" password">Forgot Password ?</a>
                                                                </div>

                                                            </div>
                                                            <label class="py-3">
                                                                <input type="checkbox" required="" class="d-inline">
                                                                <span class="label-body text-black">Remember Me</span>
                                                            </label>
                                                            <div class="d-grid my-3">
                                                                <button class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Log
                                                                    In</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade active show" id="nav-register2" role="tabpanel" aria-labelledby="nav-register-tab2">
                                                        <form id="form4" class="form-group flex-wrap p-3 ">
                                                            <div class="form-input col-lg-12 my-4">
                                                                <label for="exampleInputEmail4" class="form-label fs-6 text-uppercase fw-bold text-black">Email
                                                                    Address</label>
                                                                <input type="text" id="exampleInputEmail4" name="email" placeholder="Email" class="form-control ps-3">
                                                            </div>
                                                            <div class="form-input col-lg-12 my-4">
                                                                <label for="inputPassword4" class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                                                                <input type="password" id="inputPassword4" placeholder="Password" class="form-control ps-3" aria-describedby="passwordHelpBlock">
                                                            </div>
                                                            <label class="py-3">
                                                                <input type="checkbox" required="" class="d-inline">
                                                                <span class="label-body text-black">I agree to the <a href="#" class="text-black password border-bottom">Privacy Policy</a>
                                                                </span>
                                                            </label>
                                                            <div class="d-grid my-3">
                                                                <button class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Sign
                                                                    Up</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>

                    </div>
                </div>


            </div>
        </nav>
    </header>

    <section id="page-billboard" style="background-image: url(home-assets/images/residence.png); margin-top: 150px">
        <div id="contact" class="container py-5 ">
            <div class="page-billboard-container">
                <h1 class=" text-capitalize  lh-1 mb-3">Contact Us</h1>
                <span class="item"><a href="home.php" class="text-white">Home</a></span> &nbsp; / &nbsp; <span class="item">Contact</span>
            </div>
        </div>
    </section>

    <section class="contact-us-wrap py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="contact-info col-md-6">
                    <h2 class="fs-3 text-uppercase mb-4">Contact information</h2>
                    <div class="page-content">
                        <div class="col-md-6">
                            <div class="content-box my-5">
                                <h5 class="element-title text-uppercase fs-6 fw-bold ">Head Office</h5>
                                <div class="contact-address">
                                    <p>Marawoy-Dagatan 4217
                                        Lipa Batangas Philippines</p>
                                </div>
                                <div class="contact-number ">
                                    <a href="#">0966 415 1764</a>
                                </div>
                                <div class="email-address">
                                    <p>
                                        <a href="#">college.registrar.kll</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inquiry-item col-md-6">
                    <h2 class="fs-3 text-uppercase mb-4">Got any questions?</h2>
                    <p>Use the form below to get in touch with us.</p>
                    <form id="form" class="form-group flex-wrap">
                        <div class="form-input col-lg-12 d-flex mb-3">
                            <input type="text" name="email" placeholder="Your Name Here" class="form-control ps-3 me-3">
                            <input type="text" name="email" placeholder="Your Email Here" class="form-control ps-3">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="email" placeholder="Phone Number" class="form-control ps-3">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="text" name="email" placeholder="Your Subject Here" class="form-control ps-3">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <textarea placeholder="Your Message Here" class="form-control ps-3" rows="8"></textarea>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg text-uppercase btn-rounded-none">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="google-map">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Marawoy-Dagatan%204217%20Lipa%20Batangas%20Philippines%20Kolehiyo%20ng%20Lungosd%20ng%20Lipa&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                <a href="https://getasearch.com/fmovies"></a><br>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: left;
                        /* Change text-align to left */
                        height: 500px;
                        width: 100%;
                    }
                </style>
                <a href="https://www.embedgooglemap.net">embedgooglemap.net</a>
                <style>
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 500px;
                        width: 100%;
                    }
                </style>
            </div>
        </div>
    </section>



    <!-- Footer start  -->
    <section style="background-color: black !important;" id="footer">
        <div class="container footer-container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5  ">

                <div class=" col-md-5 mb-5">
                    <h3><img id="footer-logo" style="height: 100px; width: 350px;" src="home-assets/images/homepage-kll-logo.png" alt="image">
                    </h3>
                    <p><ion-icon name="location-outline"></ion-icon> Marawoy-Dagatan 4217 <br> Lipa Batangas Philippines</p>
                    <p><ion-icon name="mail-outline"></ion-icon> college.registrar.kll</p>
                    <p><ion-icon name="call-outline"></ion-icon> 0966 415 1764</p>
                    <i class="bi-facebook pe-4"></i>
                    <i class="bi-instagram pe-4"></i>
                    <i class="bi-twitter pe-4"></i>
                </div>


                <div class="col-md-4 mb-3 ">
                    <h5>Offered course</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">College in Business Administration</p>
                        </li>
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">College of Communication Arts </p>
                        </li>
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">College of Criminal Justice </p>
                        </li>
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">College of Computer Studies </p>
                        </li>
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">College of Teacher Education </p>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 ">
                    <h5>Office hours</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">Monday to Friday </p>
                        </li>
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">8:00 am – 5:00 pm</p>
                        </li>
                        <li class="nav-item mb-2">
                            <p style="margin: 0 !important;" class="nav-link p-0 ">Saturday </p>
                        </li>
                        <li class="nav-item mb-2">
                            <p class="nav-link p-0 ">8:00 am – 12:00 pm</p>
                        </li>
                    </ul>
                </div>
            </footer>
        </div>



        <footer class="d-flex flex-wrap justify-content-between align-items-center border-top"></footer>

        <div class="container">
            <footer class="p-2 mt-2">
                <div class="">
                    <p style="text-align: center !important;">© 2024 Made by: Group - #</p>

                </div>
            </footer>
        </div>
    </section>


    <script src="home-assets/js/jquery-1.11.0.min.js"></script>
    <script src="home-assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>