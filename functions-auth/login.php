<?php
include '../database/connection.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo 'Warning: Fill up all fields first';
    } else {
        $stmt_admin = $conn->prepare("SELECT * FROM `tbl_admin` WHERE email = ? AND password = ?");
        $stmt_admin->execute([$email, $password]);
        $admin = $stmt_admin->fetch(PDO::FETCH_ASSOC);

        $stmt_student = $conn->prepare("SELECT * FROM `tbl_student` WHERE student_email = ? AND student_password = ?");
        $stmt_student->execute([$email, $password]);
        $student = $stmt_student->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            session_start();
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['login_success'] = true;
            header('location: ../admin/pages/dashboard.php');
        } elseif ($student) {
            session_start();
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['login_success'] = true;
            header('location: ../student/pages/dashboard.php');
        } else {
            echo 'Invalid Credentials';
        }
    }
} else {
    header('location: ../home');
}
