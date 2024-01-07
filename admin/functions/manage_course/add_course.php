<?php
include '../../../database/connection.php';

session_start();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = $_POST['course'];

    $check_course = $conn->prepare("SELECT COUNT(*) FROM `tbl_course` WHERE course = ?");
    $check_course->execute([$course]);
    $course_exist = $check_course->fetchColumn();

    if ($course_exist) {
        $_SESSION['error_message'] = 'Course already exists. Please choose a different name.';
        header("Location: ../../pages/manage_course/add_course.php");
        exit();
    } else {
        $course_stmt = $conn->prepare("INSERT INTO `tbl_course` (course) VALUES (?)");
        $course_stmt->execute([$course]);
        $_SESSION['success_message'] = "Well done! course added successfully";
        header("Location: ../../pages/manage_course/add_course.php");
        exit();
    }
};
