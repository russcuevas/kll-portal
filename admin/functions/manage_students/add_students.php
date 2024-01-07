<?php
include '../../../database/connection.php';
session_start();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $year_id = $_POST['year_id'];
    $course_id = $_POST['course_id'];
    $student_no = $_POST['student_no'];
    $student_fullname = $_POST['student_fullname'];
    $student_email = $_POST['student_email'];
    $student_address = $_POST['student_address'];
    $student_contact = $_POST['student_contact'];
    $password = $_POST['password'];

    $check_email = $conn->prepare("SELECT COUNT(*) FROM `tbl_student` WHERE student_email = ?");
    $check_email->execute([$student_email]);
    $email_exist = $check_email->fetchColumn();

    $check_student_no = $conn->prepare("SELECT COUNT(*) FROM `tbl_student` WHERE student_no = ?");
    $check_student_no->execute([$student_no]);
    $student_no_exist = $check_student_no->fetchColumn();

    if ($email_exist || $student_no_exist) {
        $_SESSION['error_message'] = 'Email or student number already exists. Please use a different email or student number.';
        header("Location: ../../pages/manage_students/add_students.php");
        exit();
    } else {
        $target_directory = "../../../images/profile_picture/";
        $file_name = basename($_FILES["student_profile"]["name"]);
        $target_file_path = $target_directory . $file_name;
        $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);

        if (isset($_POST["submit"]) && !empty($_FILES["student_profile"]["name"])) {
            $allow_types = array("jpg", "jpeg", "png");
            if (in_array($file_type, $allow_types)) {
                move_uploaded_file($_FILES["student_profile"]["tmp_name"], $target_file_path);
            } else {
                $_SESSION['error_message'] = "Sorry, only JPG, JPEG, and PNG files are allowed.";
                header("Location: ../../pages/manage_students/add_students.php");
                exit();
            }
        }

        $marks = 'Enrolled';

        $insert_stmt = $conn->prepare("
        INSERT INTO `tbl_student` (student_no, student_fullname, student_email, student_password, student_contact, student_address, marks, year_id, course_id, student_profile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
    ");

        $insert_stmt->execute([$student_no, $student_fullname, $student_email, $password, $student_contact, $student_address, $marks, $year_id, $course_id, $file_name]);

        $_SESSION['success_message'] = "Well done! student added successfully";
        header("Location: ../../pages/manage_students/add_students.php");
        exit();
    }
}
