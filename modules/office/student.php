<?php
include '../../includes/common.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $studentcode = $_POST['studentcode'];
    $studentname = isset($_POST['studentname'])? $_POST['studentname']:"";
    $dateofbirth = isset($_POST['dateofbirth'])? $_POST['dateofbirth']:"";
    $deptcode = $_POST['deptcode'];

    if ($action == 'create') {
        $officeHandler->createStudent($studentcode, $studentname, $dateofbirth, $deptcode);
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Student added successfully.'];
    } elseif ($action == 'update') {
        $officeHandler->updateStudent($studentcode, $studentname, $dateofbirth, $deptcode);
        $_SESSION['alert'] = ['type' => 'info', 'message' => 'Student updated successfully.']; 
    } elseif ($action == 'delete') {
        $officeHandler->deleteStudent($studentcode);
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Student deleted successfully.'];
    }
}

$departments = $officeHandler->readDepartments();
$students = $officeHandler->readStudents();

include 'views/vw_student.php';
?>
