<?php
include '../../../database/connection.php';

if (isset($_POST['submit'])) {
    $year_id = $_POST['year_id'];
    $course_id = $_POST['course_id'];
    $student_no = $_POST['student_no'];
    $student_fullname = $_POST['student_fullname'];
    $student_email = $_POST['student_email'];
    $student_address = $_POST['student_address'];
    $student_contact = $_POST['student_contact'];
    $password = $_POST['password'];

    $target_directory = "../../../images/profile_picture/";
    $file_name = basename($_FILES["student_profile"]["name"]);
    $target_file_path = $target_directory . $file_name;
    $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);

    if (isset($_POST["submit"]) && !empty($_FILES["student_profile"]["name"])) {
        $allow_types = array("jpg", "jpeg", "png");
        if (in_array($file_type, $allow_types)) {
            move_uploaded_file($_FILES["student_profile"]["tmp_name"], $target_file_path);
        } else {
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
            exit();
        }
    }

    $marks = 'Enrolled';

    $insert_stmt = $conn->prepare("
        INSERT INTO `tbl_student` (student_no, student_fullname, student_email, student_password, student_contact, student_address, marks, year_id, course_id, student_profile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
    ");

    $insert_stmt->execute([$student_no, $student_fullname, $student_email, $password, $student_contact, $student_address, $marks, $year_id, $course_id, $fileName]);

    header('Location: success_page.php');
    exit();
} else {
    header('Location: error_page.php');
    exit();
}
