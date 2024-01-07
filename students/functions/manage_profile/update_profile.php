<?php
include '../../../database/connection.php';

session_start();
$student_id = $_SESSION['student_id'];

$error_message = '';
$success_message = '';

if (!isset($student_id)) {
    header('location: ../../../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $password = $_POST['student_password'];

    $update_password_query = "UPDATE tbl_student SET student_password = ? WHERE student_id = ?";
    $update_password_stmt = $conn->prepare($update_password_query);
    $update_password_stmt->execute([$password, $student_id]);

    $_SESSION['success_message'] = "Well done! profile updated successfully";
    header("Location: ../../pages/manage_profile/update_profile.php");
    exit();
}
