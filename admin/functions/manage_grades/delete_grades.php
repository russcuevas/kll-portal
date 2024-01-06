<?php
include '../../../database/connection.php';

$response = array();

if (isset($_GET['grade_id'])) {
    $grades_id = $_GET['grade_id'];

    $delete_grades_stmt = $conn->prepare("DELETE FROM `tbl_grades` WHERE grade_id = ?");
    $delete_grades_stmt->execute([$grades_id]);

    $response['status'] = 'success';
    $response['message'] = 'Grades deleted successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Not deleting successfully';
}

header('Content-Type: application/json');
echo trim(json_encode($response));
