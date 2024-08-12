<?php
include '../../includes/common.php';

if (isset($_POST['deptcode'])) {
    $deptHandler = new OfficeHandler();
    $deptcode = $_POST['deptcode'];
    $department = $deptHandler->getDepartmentByCode($deptcode);

    if ($department) {
        echo '<div class="card">
                <div class="card-body">
                    <p>Department Name: ' . $department['deptname'] . '</p>
                    <p>Department Location: ' . $department['deptlocation'] . '</p>
                </div>
              </div>';
    } else {
        echo '<div class="alert alert-danger">Department not found</div>';
    }
}
?>
