<?php
include '../../database/connection.php';

// Assuming you have a proper SQL query to fetch the required data
$getGrades = "SELECT 
    g.grade_id,
    g.teacher_assign,
    g.grade_value, 
    g.grade_status, 
    s.student_fullname, 
    s.student_no,
    s.student_profile,
    s.student_email, -- Include other student information as needed
    s.student_contact,
    s.student_address,
    s.year_id, -- Include the 'year_id' for joining with tbl_year
    s.course_id, -- Include the 'course_id' for joining with tbl_course
    sb.subject_name, 
    sb.subject_code,
    sb.subject_unit,
    ay.academic_year, 
    sem.semester_name,
    yr.year, -- Include the 'year' from tbl_year
    cr.course -- Include the 'course' from tbl_course
FROM tbl_grades g
LEFT JOIN tbl_student s ON g.student_id = s.student_id
LEFT JOIN tbl_subject sb ON g.subject_id = sb.subject_id
LEFT JOIN tbl_academic_year ay ON g.academic_year_id = ay.academic_year_id
LEFT JOIN tbl_semester sem ON g.semester_id = sem.semester_id
LEFT JOIN tbl_year yr ON s.year_id = yr.year_id -- Join with tbl_year
LEFT JOIN tbl_course cr ON s.course_id = cr.course_id -- Join with tbl_course";

// Execute the query and fetch data
$result = $conn->query($getGrades);


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Student Grades List</title>
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
                    <div class="name" style="text-transform: capitalize;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrator</div>
                    <div class="email">arjayolgado@gmail.com</div>
                    <div class="student_no">2021-029</div>
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
                    <li>
                        <a href="students.php">
                            <i class="material-icons">groups</i>
                            <span>Students</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="grades.php">
                            <i class="material-icons">grade</i>
                            <span>Grades</span>
                        </a>
                    </li>
                    <li>
                        <a href="pages/helper-classes.html">
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
                    <li><a href="dashboard.php"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><i class="material-icons">grade</i> Grades</li>
                </ol>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                STUDENT GRADES LIST
                            </h2>
                        </div>
                        <div class="body">
                            <div>
                                <a href="manage_grades/add_grades.php" class="btn btn-tealbtn bg-red waves-effect btn-lg" style="margin-bottom: 15px;">+ Add grades</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" style=" color: #0e0e0e !important; margin-top: 20px important!">
                                    <thead>
                                        <tr>
                                            <th>Student Details</th>
                                            <th>Subject Details</th>
                                            <th>Grade Summary</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $results) : ?>
                                            <tr>
                                                <td>
                                                    <img style="width: 50px;" src="../../images/profile_picture/<?php echo $results['student_profile'] ?>" alt=""> <br>
                                                    Year : <span style="font-weight: 900;"><?php echo $results['year']; ?></span> <br>
                                                    Course : <span style="font-weight: 900;"><?php echo $results['course']; ?> </span><br>
                                                    Name : <span style="font-weight: 900;"><?php echo $results['student_fullname']; ?></span> <br>
                                                    Student # : <span style="font-weight: 900;"><?php echo $results['student_no']; ?></span> <br>
                                                </td>

                                                <td>
                                                    Academic Year : <span style="font-weight: 900;"><?php echo $results['academic_year']; ?></span> <br>
                                                    Teacher Assign : <span style="font-weight: 900;"><?php echo $results['teacher_assign']; ?> </span> <br>
                                                    Semester : <span style="font-weight: 900;"><?php echo $results['semester_name']; ?></span> <br>
                                                    Subject code : <span style="font-weight: 900;"><?php echo $results['subject_code']; ?></span> <br>
                                                    Subject name : <span style="font-weight: 900;"><?php echo $results['subject_name']; ?></span> <br>
                                                    Unit : <span style="font-weight: 900;"><?php echo $results['subject_unit']; ?></span> <br>
                                                </td>
                                                <td>
                                                    Final grade : <span style="font-weight: 900;"><?php echo number_format($results['grade_value'], 2); ?></span> <br>
                                                    Remarks : <span style="color: <?php echo ($results['grade_status'] === 'Passed') ? 'green' : 'red'; ?>; font-weight: 900;">
                                                        <?php echo $results['grade_status']; ?>
                                                    </span>

                                                </td>
                                                <td>
                                                    <a href="manage_grades/update_grades.php?grade_id=<?php echo $results['grade_id']; ?>">Update</a>
                                                    <a href="#" data-toggle="modal" data-target="#deleteGradesModal<?php echo $results['grade_id']; ?>">Delete</a>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="deleteGradesModal<?php echo $results['grade_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteGradesModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteGradesModalLabel">Delete Grades</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Cannot undo deleting grades are you sure you want to delete this?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="deleteGradesForm" class="deleteGradesForm" data-grade-id="<?php echo $results['grade_id']; ?>" action="../functions/manage_grades/delete_grades.php" method="GET" enctype="multipart/form-data">
                                                                <input type="hidden" name="grade_id" value="<?php echo $results['grade_id']; ?>">
                                                                <button type="submit" class="btn bg-red">Delete</button>
                                                            </form>
                                                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
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
    <script src="../ajax/manage_grades/delete_grades.js"></script>

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