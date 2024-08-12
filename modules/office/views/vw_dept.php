<?php
include("../../includes/head.php");
include '../../includes/menubar.php';
$_SESSION['page']="modules/office/dept.php";
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
    <h2>Department Registration Form</h2>
    <form id="departmentForm" method="post" action="dept.php" class="mb-3">
        <div class="mb-3">
            <label for="deptcode" class="form-label">Department Code</label>
            <input type="text" class="form-control" id="deptcode" name="deptcode" required>
        </div>
        <div class="mb-3">
            <label for="deptname" class="form-label">Department Name</label>
            <input type="text" class="form-control" id="deptname" name="deptname" required>
        </div>
        <div class="mb-3">
            <label for="deptlocation" class="form-label">Department Location</label>
            <input type="text" class="form-control" id="deptlocation" name="deptlocation" required>
        </div>
        <input type="hidden" name="action" id="action" value="create">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Department Code</th>
                <th>Department Name</th>
                <th>Department Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departments as $dept): ?>
                <tr>
                    <td><?php echo $dept['deptcode']; ?></td>
                    <td><?php echo $dept['deptname']; ?></td>
                    <td><?php echo $dept['deptlocation']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning edit-btn" data-deptcode="<?php echo $dept['deptcode']; ?>">Edit</button>
                        <form method="post" action="dept.php" style="display:inline;">
                            <input type="hidden" name="deptcode" value="<?php echo $dept['deptcode']; ?>">
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
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        const deptcode = this.getAttribute('data-deptcode');
        const row = this.closest('tr');
        const deptname = row.cells[1].textContent;
        const deptlocation = row.cells[2].textContent;

        document.getElementById('deptcode').value = deptcode;
        document.getElementById('deptname').value = deptname;
        document.getElementById('deptlocation').value = deptlocation;
        document.getElementById('action').value = 'update';
    });
});
</script>
<style>
    body{
        background-image: url(https://img.freepik.com/free-photo/desk-concept-arrangement-with-glasses_23-2148604886.jpg?size=626&ext=jpg);
    }
</style>
</body>
</html>
