<?php
include '../../../database/connection.php';
session_start();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $year_id = $_POST['year_id'];
    $course_id = $_POST['course_id'];
    $student_fullname = $_POST['student_fullname'];
    $student_email = $_POST['student_email'];
    $student_address = $_POST['student_address'];
    $student_contact = $_POST['student_contact'];
    $password = $_POST['password'];

    $check_email = $conn->prepare("SELECT COUNT(*) FROM `tbl_student` WHERE student_email = ? AND student_id <> ?");
    $check_email->execute([$student_email, $student_id]);
    $email_exist = $check_email->fetchColumn();

    if ($email_exist) {
        $_SESSION['error_message'] = 'Email is already taken by other the student. Please use different email';
        header("Location: ../../pages/manage_students/update_students.php?student_id=" . $student_id);
        exit();
    } elseif (!empty($_FILES["student_profile"]["name"])) {
        $target_directory = "../../../images/profile_picture/";
        $file_name = basename($_FILES["student_profile"]["name"]);
        $target_file_path = $target_directory . $file_name;
        $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);

        $allow_types = array("jpg", "jpeg", "png");
        if (in_array($file_type, $allow_types)) {
            move_uploaded_file($_FILES["student_profile"]["tmp_name"], $target_file_path);

            $update_stmt = $conn->prepare("
                UPDATE `tbl_student`
                SET
                    year_id = ?,
                    course_id = ?,
                    student_fullname = ?,
                    student_email = ?,
                    student_address = ?,
                    student_contact = ?,
                    student_password = ?,
                    student_profile = ?
                WHERE
                    student_id = ?
            ");

            $update_stmt->execute([$year_id, $course_id, $student_fullname, $student_email, $student_address, $student_contact, $password, $file_name, $student_id]);
        } else {
            $_SESSION['error_message'] = "Sorry, only JPG, JPEG, and PNG files are allowed.";
            header("Location: ../../pages/manage_students/update_students.php?student_id=" . $student_id);
            exit();
        }
    } else {
        $update_stmt = $conn->prepare("
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

        $update_stmt->execute([$year_id, $course_id, $student_fullname, $student_email, $student_address, $student_contact, $password, $student_id]);
    }

    if (!$email_exist) {
        $_SESSION['success_message'] = "Well done! student updated successfully";
        header("Location: ../../pages/manage_students/update_students.php?student_id=" . $student_id);
        exit();
    }
}
