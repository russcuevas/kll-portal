<?php
include '../../../database/connection.php';

$response = array();

if (isset($_GET['student_id']) && isset($_GET['profile_picture'])) {
    $student_id = $_GET['student_id'];
    $profile_picture = $_GET['profile_picture'];

    $delete_student_stmt = $conn->prepare("DELETE FROM `tbl_student` WHERE student_id = ?");
    $delete_student_stmt->execute([$student_id]);

    $profile_picture_path = '../../../images/profile_picture/' . $profile_picture;
    if (file_exists($profile_picture_path)) {
        unlink($profile_picture_path);
    }

    $response['status'] = 'success';
    $response['message'] = 'Well done! student deleted successfully';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request parameters';
}

header('Content-Type: application/json');
echo trim(json_encode($response));
