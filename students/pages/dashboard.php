<?php
include '../../database/connection.php';

session_start();
$student_id = $_SESSION['student_id'];
if (!isset($student_id)) {
    header('location: ../../login.php');
}

// GETTING THE DETAILS OF THE SESSION
$student_details = "SELECT student_email, student_fullname, student_no, student_profile FROM tbl_student WHERE student_id = ?";
$student_details_stmt = $conn->prepare($student_details);
$student_details_stmt->execute([$student_id]);
$students = $student_details_stmt->fetch(PDO::FETCH_ASSOC);

$students_email = $students['student_email'];
$students_name = $students['student_fullname'];
$students_no = $students['student_no'];
$students_profile = $students['student_profile'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="../../images/login/logo-kll.jpg" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../assets/plugins/morrisjs/morris.css" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../assets/css/themes/all-themes.css" rel="stylesheet" />
    <style>
        /* additional css right sidebar */
        .tab-content ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .tab-content ul li {
            margin-top: 0 !important;
        }

        .tab-content ul li a {
            font-weight: 900;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
            margin-top: 15px;
            margin-left: 10px;
            color: black;
            display: inline-block;
            transition: color 0.3s !important;

        }

        .tab-content ul li a:hover {
            color: red !important;
        }

        .pagination li.active a {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
        }

        .breadcrumb-col-red li a {
            color: #992626 !important;
            font-weight: bold;
        }

        .theme-red .sidebar .menu .list li.active> :first-child i,
        .theme-red .sidebar .menu .list li.active> :first-child span {
            color: #992626 !important;
        }

        .dataTables_wrapper .dt-buttons a.dt-button {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
            color: #fff;
            padding: 7px 12px;
            margin-right: 5px;
            text-decoration: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.16), 0 2px 10px rgba(0, 0, 0, 0.12);
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            -ms-border-radius: 2px;
            border-radius: 2px;
            border: none;
            font-size: 13px;
            outline: none;
        }

        .bg-red {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
            color: #fff;
        }

        @keyframes moveAnnouncement {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        footer {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
        }

        .announcement-container {
            overflow: hidden;
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
            color: #fff;
        }

        .announcement {
            white-space: nowrap;
            padding: 10px;
            animation: moveAnnouncement 20s linear infinite;
        }
    </style>
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a id="app-title" style="display:flex;align-items:center" class="navbar-brand" href="">
                    <img id="bcas-logo" style="width:250px;display:inline;margin-right:10px;" src="../../images/login/homepage-kll-logo.png" />
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">account_circle</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/login/logo-kll.jpg" width="48" height="48" alt="User" />

                    <img src="../../images/profile_picture/<?php echo $students['student_profile'] ?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $students_name ?></div>
                    <div class="email"><?php echo $students_email ?></div>
                    <div class="student_no"><?php echo $students_no ?></div>
                </div>
            </div>
            <!-- #User Info -->

            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">KLL PORTAL</li>
                    <li class="active">
                        <a href="dashboard.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <li>
                        <a href="mygrades.php">
                            <i class="material-icons">grade</i>
                            <span>My Grades</span>
                        </a>
                    </li>

                    <li class="header">KLL HOMEPAGE</li>


                    <li class="">
                        <a href="../../home.php">
                            <i class="material-icons">web</i>
                            <span>Page</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">ACCOUNT</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="skins">
                    <ul style="list-style-type: none;">
                        <li>
                            <a href="manage_profile/update_profile.php" style="font-weight: 900; font-size: 15px; text-decoration: none; cursor: pointer; color: black"><i class="material-icons mr-2" style="font-size: 18px; vertical-align: middle;">lock</i> Update profile</a>
                        </li>
                    </ul>
                    <ul style="list-style-type: none;">
                        <li>
                            <a href="../functions/auth/student_logout.php" style="font-weight: 900; font-size: 15px; text-decoration: none; cursor: pointer; color: black"><i class=" material-icons mr-2" style="font-size: 18px; vertical-align: middle;">exit_to_app</i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>STUDENT DASHBOARD</h2>
            </div>

            <div class="row clearfix">
                <!-- Basic Example -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" style="background: linear-gradient(to right, #992626, #0e0e0e) !important;">
                        <div class="header">
                            <h2 style="color: white;">CAMPUS TOUR</h2>
                        </div>
                        <div class="body">
                            <div id="carousel-example-generic" data-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <video width="99%" height="auto" controls autoplay muted>
                                            <source src="../../home-assets/images/EBA.mp4" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Basic Example -->
                <!-- With Captions -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" style="background: linear-gradient(to right, #992626, #0e0e0e) !important;">
                        <div class="header">
                            <h2 style="color: white;">CAMPUS EVENTS</h2>
                        </div>
                        <div class="body">
                            <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic_2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic_2" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic_2" data-slide-to="2"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img style="opacity: 0.9;" src="../../home-assets/images/biglakasan-event-1.jpg" />
                                        <!-- <div class="carousel-caption">
                                            <h3>Cheerdance competition</h3>
                                            <p>@Kolehiyo ng lungsod ng lipa</p>
                                        </div> -->
                                    </div>
                                    <div class="item">
                                        <img src="../../home-assets/images/biglakasan-pageant.jpg" />
                                        <!-- <div class="carousel-caption">
                                            <h3>CTE Nights</h3>
                                            <p>@Kolehiyo ng lungsod ng lipa</p>
                                        </div> -->
                                    </div>
                                    <div class="item">
                                        <img src="../../home-assets/images/crim-days.jpg" />
                                        <!-- <div class="carousel-caption">
                                            <h3>CRIM Days</h3>
                                            <p>@Kolehiyo ng lungsod ng lipa</p>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br>
    <br>
    <br>
    <br>
    <br>
    <footer>
        <div class="announcement-container">
            <div class="announcement">
                <h4>Announcement: Enrollment is on going</h4>
            </div>
        </div>
    </footer>

    <!-- Jquery Core Js -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="../assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="../assets/plugins/raphael/raphael.min.js"></script>
    <script src="../assets/plugins/morrisjs/morris.js"></script>

    <!-- ChartJs -->
    <script src="../assets/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="../assets/plugins/flot-charts/jquery.flot.js"></script>
    <script src="../assets/plugins/flot-charts/jquery.flot.resize.js"></script>
    <script src="../assets/plugins/flot-charts/jquery.flot.pie.js"></script>
    <script src="../assets/plugins/flot-charts/jquery.flot.categories.js"></script>
    <script src="../assets/plugins/flot-charts/jquery.flot.time.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="../assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <!-- Custom Js -->
    <script src="../assets/js/students.js"></script>
    <script src="../assets/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="../assets/js/demo.js"></script>
</body>

</html>