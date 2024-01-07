<?php
include '../../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = $_POST['course'];

    $check_course = $conn->prepare("SELECT COUNT(*) FROM `tbl_course` WHERE course = ?");
    $check_course->execute([$course]);
    $course_exist = $check_course->fetchColumn();

    if ($course_exist) {
        echo 'Course already exists. Please choose a different name.';
    } else {
        $course_stmt = $conn->prepare("INSERT INTO `tbl_course` (course) VALUES (?)");
        $course_stmt->execute([$course]);
        echo 'Course added successfully';
    }
};
