<?php
include '../../../database/connection.php';

session_start();
$admin_id = $_SESSION['admin_id'];

$error_message = '';
$success_message = '';

if (!isset($admin_id)) {
    header('location: ../../../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_email_query = "SELECT admin_id FROM tbl_admin WHERE email = ? AND admin_id != ?";
    $check_email_stmt = $conn->prepare($check_email_query);
    $check_email_stmt->execute([$email, $admin_id]);

    if ($check_email_stmt->rowCount() > 0) {
        $_SESSION['error_message'] = "Email already exists. Please choose a different one.";
        header("Location: ../../pages/manage_profile/update_profile.php");
        exit();
    } else {
        $update_profile_query = "UPDATE tbl_admin SET fullname = ?, email = ?, password = ? WHERE admin_id = ?";
        $update_profile_stmt = $conn->prepare($update_profile_query);
        $update_profile_stmt->execute([$fullname, $email, $password, $admin_id]);

        $_SESSION['success_message'] = "Well done! Profile updated successfully";
        header("Location: ../../pages/manage_profile/update_profile.php");
        exit();
    }
}
