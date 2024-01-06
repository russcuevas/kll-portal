<?php
include '../../../database/connection.php';

// Fetch data for tbl_year
$yearStmt = $conn->query("SELECT * FROM tbl_year");
$years = $yearStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch data for tbl_course
$courseStmt = $conn->query("SELECT * FROM `tbl_course`");
$courses = $courseStmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    $stmt = $conn->prepare("
        SELECT 
            s.*, 
            y.year, 
            c.course 
        FROM `tbl_student` s
        LEFT JOIN `tbl_year` y ON s.year_id = y.year_id
        LEFT JOIN `tbl_course` c ON s.course_id = c.course_id
        WHERE s.student_id = ?
    ");

    $stmt->execute([$student_id]);

    if ($stmt->rowCount() === 0) {
        header('location: dashboard');
        exit();
    } else {
        $students = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Update Students</title>
    <!-- Favicon-->
    <link rel="icon" href="../../assets/favicon.ico" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../assets/css/themes/all-themes.css" rel="stylesheet" />
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

        .form-group .form-line.focused .form-label,
        .form-group .form-line .form-label {
            top: -15px !important;
            color: #212529 !important;
            font-weight: 900;
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
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a id="app-title" style="display:flex;align-items:center" class="navbar-brand" href="../dashboard.php">
                    <img id="bcas-logo" style="width:250px;display:inline;margin-right:10px;" src="../../../images/login/homepage-kll-logo.png" />
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
                    <img src="../../../images/login/logo-kll.jpg" width="48" height="48" alt="User" />

                    <img src="https://tse2.mm.bing.net/th?id=OIP.fqSvfYQB0rQ-6EG_oqvonQHaHa&pid=Api&P=0&h=180" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" style="text-transform: capitalize;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrator</div>
                    <div class="email">arjayolgado@gmail.com</div>
                    <div class="student_no">2021-029</div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu" style="overflow: hidden;">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="home.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="students.php">
                            <i class="material-icons">groups</i>
                            <span>Students</span>
                        </a>
                    </li>
                    <li>
                        <a href="students_grades.php">
                            <i class="material-icons">groups</i>
                            <span>Students Grades</span>
                        </a>
                    </li>

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
                            <a style="font-weight: 900; font-size: 15px; text-decoration: none; cursor: pointer; color: black"><i class="material-icons mr-2" style="font-size: 18px; vertical-align: middle;">lock</i> Update profile</a>
                        </li>
                    </ul>
                    <ul style="list-style-type: none;">
                        <li>
                            <a style="font-weight: 900; font-size: 15px; text-decoration: none; cursor: pointer; color: black"><i class=" material-icons mr-2" style="font-size: 18px; vertical-align: middle;">exit_to_app</i> Logout</a>
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
                <ol class="breadcrumb breadcrumb-col-red">
                    <li><a href="../dashboard.php"><i class="material-icons">home</i> Home</a></li>
                    <li><a href="../students.php"><i class="material-icons">groups</i> Students</a></li>
                    <li class="active"><i class="material-icons">groups</i> Update Students</li>
                </ol>
            </div>
            <!-- Advanced Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>STUDENT ID: <?php echo $students['student_no'] ?></h2>
                        </div>
                        <div class="body">
                            <form id="form_advanced_validation" action="../../functions/manage_students/update_students.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="student_id" value="<?php echo $students['student_id'] ?>">
                                <input type="hidden" name="year_id" value="<?php echo $students['year_id'] ?>">
                                <input type="hidden" name="course_id" value="<?php echo $students['course_id'] ?>">


                                <div class="form-group form-float">
                                    <label id="fileLabel" for="productImageInput">Student 2x2 picture</label>
                                    <div class="form-line">
                                        <input id="productImageInput" type="file" autocomplete="off" class="form-control" name="student_profile" onchange="previewImage(this)" <?php echo (isset($students['student_profile']) && !empty($students['student_profile'])) ? 'data-existing="' . $students['student_profile'] . '"' : ''; ?>>
                                        <div class="help-info">JPEG/JPG/PNG</div>
                                    </div>
                                    <?php
                                    if (isset($students['student_profile']) && !empty($students['student_profile'])) {
                                        $existing_profile_pic = '../../../images/profile_picture/' . $students['student_profile'];
                                        echo '<img id="imagePreview" style="display: block; margin-top: 10px;" width="100" height="100" alt="" src="' . $existing_profile_pic . '">';
                                    } else {
                                        echo '<img id="imagePreview" style="display: block; margin-top: 10px;" width="100" height="100" alt="">';
                                    }
                                    ?>
                                </div>


                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="year_id" class="form-control show-tick">
                                            <option value="" disabled>-- Year Level --</option>
                                            <?php foreach ($years as $year) : ?>
                                                <option value="<?php echo $year['year_id']; ?>" <?php echo ($year['year_id'] == $students['year_id']) ? 'selected' : ''; ?>><?php echo $year['year']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select name="course_id" class="form-control show-tick">
                                            <option value="" disabled>-- Course --</option>
                                            <?php foreach ($courses as $course) : ?>
                                                <option value="<?php echo $course['course_id']; ?>" <?php echo ($course['course_id'] == $students['course_id']) ? 'selected' : ''; ?>><?php echo $course['course']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <br>
                                <br>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="student_fullname" value="<?php echo $students['student_fullname'] ?>" required>
                                        <label class="form-label">Fullname</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="student_email" value="<?php echo $students['student_email'] ?>" required>
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="student_address" value="<?php echo $students['student_address'] ?>" required>
                                        <label class="form-label">Address</label>
                                    </div>
                                    <div class="help-info">House number, Barangay</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" name="student_contact" value="<?php echo $students['student_contact'] ?>" maxlength="11" required>
                                        <label class="form-label">Number</label>
                                    </div>
                                    <div class="help-info">09123456789</div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="password" value="<?php echo $students['student_password'] ?>" maxlength="20" minlength="6" required>
                                        <label class=" form-label">Password</label>
                                    </div>
                                    <div class="help-info">Min.6, Max 20 characters.</div>

                                </div>
                                <input class="btn bg-red" type="submit" name="submit" value="Save changes">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Validation -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../../assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="../../assets/plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../../assets/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../assets/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../assets/js/admin.js"></script>
    <script src="../../assets/js/pages/forms/form-validation.js"></script>

    <!-- Demo Js -->
    <script src="../../assets/js/demo.js"></script>
    <script>
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.width = '100px';
                preview.style.height = '100px';
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fileInput = document.getElementById('productImageInput');

            if (fileInput.dataset.existing) {
                fileInput.value = fileInput.dataset.existing;
            }
        });
    </script>
</body>

</html>