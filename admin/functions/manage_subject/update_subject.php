<?php
include '../../../database/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = $_POST['subject_id'];
    $subject_code = $_POST['subject_code'];
    $subject_name = $_POST['subject_name'];
    $subject_unit = $_POST['subject_unit'];

    $check_subject_name = $conn->prepare("SELECT COUNT(*) FROM `tbl_subject` WHERE subject_name = ? AND subject_id <> ?");
    $check_subject_name->execute([$subject_name, $subject_id]);
    $subject_name_exist = $check_subject_name->fetchColumn();

    $check_subject_code = $conn->prepare("SELECT COUNT(*) FROM `tbl_subject` WHERE subject_code = ? AND subject_id <> ?");
    $check_subject_code->execute([$subject_code, $subject_id]);
    $subject_code_exist = $check_subject_code->fetchColumn();

    if ($subject_name_exist) {
        echo 'Subject with the given name already exists. Please choose a different name.';
    } elseif ($subject_code_exist) {
        echo 'Subject with the given code already exists. Please choose a different code.';
    } else {
        $subject_stmt = $conn->prepare("UPDATE `tbl_subject` SET subject_code = ?, subject_name = ?, subject_unit = ? WHERE subject_id = ?");
        $subject_stmt->execute([$subject_code, $subject_name, $subject_unit, $subject_id]);
        echo 'Subject updated successfully';
    }
}
