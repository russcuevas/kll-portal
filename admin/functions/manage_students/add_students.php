<?php
include '../../../database/connection.php';

if (isset($_POST['submit'])) {
    $year_id = $_POST['year_id'];
    $course_id = $_POST['course_id'];
    $student_fullname = $_POST['student_fullname'];
    $student_email = $_POST['student_email'];
    $student_address = $_POST['student_address'];
    $student_contact = $_POST['student_contact'];
    $password = $_POST['password'];

    $marks = 'Enrolled';

    $insert_stmt = $conn->prepare("
        INSERT INTO `tbl_student` (student_no, student_fullname, student_email, student_password, student_contact, student_address, marks, year_id, course_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
    ");

    $insert_stmt->execute([$year_id, $course_id, $student_fullname, $student_email, $password, $student_contact, $student_address, $marks, $year_id, $course_id]);

    header('Location: success_page.php');
    exit();
} else {
    header('Location: error_page.php');
    exit();
}
