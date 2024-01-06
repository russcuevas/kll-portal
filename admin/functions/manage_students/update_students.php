<?php
include '../../../database/connection.php';

if (isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $year_id = $_POST['year_id'];
    $course_id = $_POST['course_id'];
    $student_fullname = $_POST['student_fullname'];
    $student_email = $_POST['student_email'];
    $student_address = $_POST['student_address'];
    $student_contact = $_POST['student_contact'];
    $password = $_POST['password'];

    $updateStmt = $conn->prepare("
        UPDATE `tbl_student`
        SET
            year_id = ?,
            course_id = ?,
            student_fullname = ?,
            student_email = ?,
            student_address = ?,
            student_contact = ?,
            student_password = ?
        WHERE
            student_id = ?
    ");

    $updateStmt->execute([$year_id, $course_id, $student_fullname, $student_email, $student_address, $student_contact, $password, $student_id]);

    header('Location: success_page.php');
    exit();
} else {
    header('Location: error_page.php');
    exit();
}
