<?php
include("../../includes/head.php");
include '../../includes/menubar.php';
$_SESSION['page']="modules/office/student.php";
if (isset($_SESSION['alert'])):
    $alert = $_SESSION['alert'];
    unset($_SESSION['alert']);
?>
    <div class="container mt-3">
        <div class="alert alert-<?php echo $alert['type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $alert['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2>Student Registration Form</h2>
    <form id="studentForm" method="post" action="student.php" class="mb-3">
        <div class="mb-3">
            <label for="studentcode" class="form-label">Student Code</label>
            <input type="text" class="form-control" id="studentcode" name="studentcode" required>
        </div>
        <div class="mb-3">
            <label for="studentname" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="studentname" name="studentname" required>
        </div>
        <div class="mb-3">
            <label for="dateofbirth" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" required>
        </div>
        <div class="mb-3">
            <label for="deptcode" class="form-label">Department Code</label>
            <select class="form-select" id="deptcode" name="deptcode" required>
                <option value="">Select Department</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?php echo $dept['deptcode']; ?>"><?php echo $dept['deptcode']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div id="deptDetails" class="mb-3"></div>
        <input type="hidden" name="action" id="action" value="create">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student Code</th>
                <th>Student Name</th>
                <th>Date of Birth</th>
                <th>Department Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['studentcode']; ?></td>
                    <td><?php echo $student['studentname']; ?></td>
                    <td><?php echo $student['dateofbirth']; ?></td>
                    <td><?php echo $student['deptcode']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn" data-studentcode="<?php echo $student['studentcode']; ?>">Edit</button>
                        <form method="post" action="student.php" style="display:inline;">
                            <input type="hidden" name="studentcode" value="<?php echo $student['studentcode']; ?>">
                            <input type="hidden" name="action" value="delete">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
include '../../includes/footerjs.php';
include '../../includes/footer.php';
?>
 
<script>
$(document).ready(function() {
    $('#deptcode').change(function() {
        var deptcode = $(this).val();
        if (deptcode) {
            $.ajax({
                url: 'fetch_dept.php',
                type: 'POST',
                data: {deptcode: deptcode},
                success: function(response) {
                    $('#deptDetails').html(response);
                }
            });
        } else {
            $('#deptDetails').html('');
        }
    });
});
</script>
<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const studentcode = this.getAttribute('data-studentcode');
            const row = this.closest('tr');
            const studentname = row.cells[1].textContent;
            const dateofbirth = row.cells[2].textContent;
            const deptcode = row.cells[3].textContent;

            document.getElementById('studentcode').value = studentcode;
            document.getElementById('studentname').value = studentname;
            document.getElementById('dateofbirth').value = dateofbirth;
            document.getElementById('deptcode').value = deptcode;
            document.getElementById('action').value = 'update';

            $('#deptcode').trigger('change');
        });
    });

</script>
<style>
    body{
        background-image: url(https://img.freepik.com/free-photo/office-supplies_23-2148103974.jpg?size=626&ext=jpg);
    }
</style>
</body>
</html>
