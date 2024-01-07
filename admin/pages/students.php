<?php
include '../../database/connection.php';

session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location: ../../login.php');
}

// GETTING THE DETAILS OF THE SESSION
$sql_admin_details = "SELECT email, fullname FROM tbl_admin WHERE admin_id = ?";
$stmt_admin_details = $conn->prepare($sql_admin_details);
$stmt_admin_details->execute([$admin_id]);
$admin_details = $stmt_admin_details->fetch(PDO::FETCH_ASSOC);

$admin_email = $admin_details['email'];
$admin_fullname = $admin_details['fullname'];

$getStudents = "SELECT 
                    s.*, 
                    y.year, 
                    c.course 
                FROM `tbl_student` s
                LEFT JOIN `tbl_year` y ON s.year_id = y.year_id
                LEFT JOIN `tbl_course` c ON s.course_id = c.course_id";

$getStmt = $conn->query($getStudents);
$students = $getStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Student List</title>
    <!-- Favicon-->
    <link rel="icon" href="../assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Bootstrap Select Css -->
    <link href="../assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="../assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

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

                    <img src="https://tse2.mm.bing.net/th?id=OIP.fqSvfYQB0rQ-6EG_oqvonQHaHa&pid=Api&P=0&h=180" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $admin_fullname; ?></div>
                    <div class="email"><?php echo $admin_email; ?></div>
                    <div class="student_no">NO STUDENT NUMBER</div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="dashboard.php">
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
                        <a href="grades.php">
                            <i class="material-icons">grade</i>
                            <span>Grades</span>
                        </a>
                    </li>
                    <li>
                        <a href="course.php">
                            <i class="material-icons">book</i>
                            <span>Course</span>
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
                            <a href="../functions/auth/admin_logout.php" style="font-weight: 900; font-size: 15px; text-decoration: none; cursor: pointer; color: black"><i class=" material-icons mr-2" style="font-size: 18px; vertical-align: middle;">exit_to_app</i> Logout</a>
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
                    <li><a href="dashboard.php"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><i class="material-icons">groups</i> Students</li>
                </ol>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                STUDENT LIST
                            </h2>
                        </div>
                        <div class="body">
                            <div>
                                <a href="manage_students/add_students.php" class="btn btn-tealbtn bg-red waves-effect btn-lg" style="margin-bottom: 15px;">+ Add students</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style=" color: #0e0e0e !important; margin-top: 20px important!">
                                    <thead>
                                        <tr>
                                            <th>Student #</th>
                                            <th>Student Profile</th>
                                            <th>Student Name</th>
                                            <th>Student Year</th>
                                            <th>Student Course</th>
                                            <th>Marks</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($students as $student) : ?>
                                            <tr>
                                                <td><?php echo $student['student_no'] ?></td>
                                                <td><img style="width: 50px;" src="../../images/profile_picture/<?php echo $student['student_profile'] ?>" alt=""></td>
                                                <td><?php echo $student['student_fullname'] ?></td>
                                                <td><?php echo $student['year'] ?> - Year College</td>
                                                <td><?php echo $student['course'] ?></td>
                                                <td style="color: green;"><?php echo $student['marks'] ?></td>
                                                <td>
                                                    <a class="btn bg-red" href="">View</a>
                                                    <a class="btn bg-red" href="manage_students/update_students.php?student_id=<?php echo $student['student_id']; ?>">Update</a>
                                                    <a class="btn bg-red" href="#" data-toggle="modal" data-target="#deleteStudentsModal<?php echo $student['student_id'] ?>">Delete</a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="deleteStudentsModal<?php echo $student['student_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteStudentsModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteStudentsModalLabel">Delete Student</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this student <?php echo $student['student_fullname'] ?>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="deleteStudentsForm" class="deleteStudentsForm" data-student-id="<?php echo $student['student_id']; ?>" data-profile-picture="<?php echo $student['student_profile']; ?>" action="../functions/manage_students/delete_students.php" method="GET" enctype="multipart/form-data">
                                                                <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
                                                                <input type="hidden" name="profile_picture" value="<?php echo $student['student_profile']; ?>">
                                                                <button type="submit" class="btn bg-red">Delete</button>
                                                            </form>
                                                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

    </section>

    <!-- Jquery Core Js -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="../ajax/manage_students/delete_students.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../assets/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="../assets/js/pages/forms/basic-form-elements.js"></script>
    <script src="../assets/js/pages/forms/form-validation.js"></script>
    <!-- Demo Js -->
    <script src="../assets/js/demo.js"></script>
</body>

</html>