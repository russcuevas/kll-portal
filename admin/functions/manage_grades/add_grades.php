<?php
include '../../../database/connection.php';
session_start();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $academic_year_id = $_POST['academic_year_id'];
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $semester_id = $_POST['semester_id'];
    $teacher_assign = $_POST['teacher_assign'];
    $grade_value = $_POST['grade_value'];

    if ($grade_value >= 3.01) {
        $grade_status = 'Failed';
    } elseif ($grade_value >= 1.00) {
        $grade_status = 'Passed';
    } else {
        $grade_status = 'INC';
    }

    $sql = "INSERT INTO tbl_grades (academic_year_id, student_id, subject_id, semester_id, teacher_assign, grade_value, grade_status)
            VALUES (:academic_year_id, :student_id, :subject_id, :semester_id, :teacher_assign, :grade_value, :grade_status)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':academic_year_id', $academic_year_id, PDO::PARAM_INT);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
    $stmt->bindParam(':semester_id', $semester_id, PDO::PARAM_INT);
    $stmt->bindParam(':teacher_assign', $teacher_assign, PDO::PARAM_STR);
    $stmt->bindParam(':grade_value', $grade_value, PDO::PARAM_STR);
    $stmt->bindParam(':grade_status', $grade_status, PDO::PARAM_STR);

    $stmt->execute();

    $_SESSION['success_message'] = "Well done! grades added successfully";
    header("Location: ../../pages/manage_grades/add_grades.php");
    exit();
}
