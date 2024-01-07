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

    $check_email = $conn->prepare("SELECT COUNT(*) FROM `tbl_student` WHERE student_email = ? AND student_id <> ?");
    $check_email->execute([$student_email, $student_id]);
    $email_exist = $check_email->fetchColumn();

    if ($email_exist) {
        echo 'Email already exists for another student. Please use a different email.';
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
            echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
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
        echo 'Updated student successfully';
    }
} else {
    echo 'Error updating student';
}
