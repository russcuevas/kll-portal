<?php
include '../database/connection.php';

$response = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $response['status'] = 'warning';
        $response['message'] = 'Please fill up all fields first';
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
            $response['status'] = 'success';
            $response['role'] = 'admin';
        } elseif ($student) {
            session_start();
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['login_success'] = true;
            $response['status'] = 'success';
            $response['role'] = 'student';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid credentials';
        }
    }
} else {
    header('location: ../home');
}

header("Content-type: application/json");
echo json_encode($response);
