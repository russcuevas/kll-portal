<?php
include '../../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['course_id'];
    $new_course = $_POST['course'];

    $check_exist_stmt = $conn->prepare("SELECT COUNT(*) FROM `tbl_course` WHERE course = ? AND course_id != ?");
    $check_exist_stmt->execute([$new_course, $course_id]);
    $course_exists = $check_exist_stmt->fetchColumn();

    if ($course_exists) {
        echo 'Course already exists. Please choose a different name.';
    } else {
        $update_course_stmt = $conn->prepare("UPDATE `tbl_course` SET course = ? WHERE course_id = ?");
        $update_course_stmt->execute([$new_course, $course_id]);
        echo 'Course updated successfully';
    }
}
