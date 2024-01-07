<?php
include '../../../database/connection.php';

session_start();
$student_id = $_SESSION['student_id'];
if (!isset($student_id)) {
    header('location: ../../../login.php');
}

// Assuming you have a proper SQL query to fetch the required data
$student_id = $_SESSION['student_id'];
$getGrades = "SELECT
g.grade_id,
g.teacher_assign,
g.grade_value,
g.grade_status,
s.student_fullname,
s.student_no,
s.student_profile,
s.student_email,
s.student_contact,
s.student_address,
s.year_id,
s.course_id,
sb.subject_name,
sb.subject_code,
sb.subject_unit,
ay.academic_year,
sem.semester_name,
yr.year,
cr.course
FROM tbl_grades g
LEFT JOIN tbl_student s ON g.student_id = s.student_id
LEFT JOIN tbl_subject sb ON g.subject_id = sb.subject_id
LEFT JOIN tbl_academic_year ay ON g.academic_year_id = ay.academic_year_id
LEFT JOIN tbl_semester sem ON g.semester_id = sem.semester_id
LEFT JOIN tbl_year yr ON s.year_id = yr.year_id
LEFT JOIN tbl_course cr ON s.course_id = cr.course_id
WHERE g.student_id = $student_id"; // Add the condition to filter grades for the specific student

// Execute the query and fetch data
$result = $conn->query($getGrades);

// Fetch a single row from the result set
$student_data = $result->fetch(PDO::FETCH_ASSOC)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>My grade</title>
    <style>
        body {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;

        }

        .profile-button:focus {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
            ;
            box-shadow: none
        }

        .profile-button:active {
            background: linear-gradient(to right, #992626, #0e0e0e) !important;
            ;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="../../../images/profile_picture/<?php echo $student_data['student_profile'] ?>">
                    <span class="font-weight-bold"><?php echo $student_data['student_fullname'] ?></span>
                    <span class="font-weight-bold"><?php echo $student_data['student_no'] ?></span>

                    <span class="text-black-50"><?php echo $student_data['student_address'] ?></span>
                    <span class="text-black-50"><?php echo $student_data['student_contact'] ?></span>
                    <span class="text-black-50"><?php echo $student_data['student_email'] ?></span>
                    <span>

                    </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Grade Summary</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels" style="font-weight: 900;">Academic Year</label>
                            <p style="color: #992626; font-weight: 900;"><?php echo $student_data['academic_year'] ?></p>
                        </div>
                        <div class="col-md-6"><label class="labels" style="font-weight: 900;">Semester</label>
                            <p style="color: #992626; font-weight: 900;"><?php echo $student_data['semester_name'] ?></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels" style="font-weight: 900;">Subject code : </label>
                            <p><?php echo $student_data['subject_code'] ?></p>
                        </div>
                        <div class="col-md-12"><label class="labels" style="font-weight: 900;">Subject name : </label>
                            <p><?php echo $student_data['subject_name'] ?></p>
                        </div>
                        <div class="col-md-12"><label class="labels" style="font-weight: 900;">Subject unit : </label>
                            <p><?php echo $student_data['subject_unit'] ?></p>
                        </div>
                        <div class="col-md-12"><label class="labels" style="font-weight: 900;">Teacher assigned : </label>
                            <p><?php echo $student_data['teacher_assign'] ?></p>
                        </div>
                    </div>

                    <div onclick="window.location.replace('../mygrades.php');" class="mt-5 text-center">
                        <button class="btn btn-primary profile-button" type="button">Go back</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <?php
                        $gradeValue = $student_data['grade_value'];
                        $formattedGradeValue = number_format($gradeValue, 2);
                        $gradeStatus = $student_data['grade_status'];

                        $color = '';

                        if ($gradeValue >= 3.01) {
                            $color = 'red';
                        } elseif ($gradeValue >= 1.00) {
                            $color = 'green';
                        } else {
                            $color = 'orange';
                        }
                        ?>

                        <span style="color: <?php echo $color; ?>">FINAL : <?php echo $formattedGradeValue ?></span>

                        <span class="border px-3 p-1 add-experience" style="background-color: <?php echo $color; ?>; color: white;">
                            <i class="fa fa-plus"></i>&nbsp;<?php echo $gradeStatus ?>
                        </span>
                    </div>
                    <br>
                    <img src="../../../images/login/school-background.jpg" style="width: 360px; height: 350px" alt="">
                    <h3>Thankyou! enroll again</h3>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>