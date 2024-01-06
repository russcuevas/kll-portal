<?php
include '../../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $academic_year_id = $_POST['academic_year_id'];
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $semester_id = $_POST['semester_id'];
    $teacher_assign = $_POST['teacher_assign'];
    $grade_value = $_POST['grade_value'];

    // Determine grade status based on grade value
    $grade_status = ($grade_value >= 3.25) ? 'Failed' : 'Passed';

    // Insert into the tbl_grades table
    $sql = "INSERT INTO tbl_grades (academic_year_id, student_id, subject_id, semester_id, teacher_assign, grade_value, grade_status)
            VALUES (:academic_year_id, :student_id, :subject_id, :semester_id, :teacher_assign, :grade_value, :grade_status)";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':academic_year_id', $academic_year_id, PDO::PARAM_INT);
    $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
    $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
    $stmt->bindParam(':semester_id', $semester_id, PDO::PARAM_INT);
    $stmt->bindParam(':teacher_assign', $teacher_assign, PDO::PARAM_STR);
    $stmt->bindParam(':grade_value', $grade_value, PDO::PARAM_STR);
    $stmt->bindParam(':grade_status', $grade_status, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    header('Location: success_page.php');
    exit();
} else {
    header('Location: error_page.php');
    exit();
}
