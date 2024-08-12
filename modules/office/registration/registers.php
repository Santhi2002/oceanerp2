<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rollNo = $_POST['studentRollNo'];
    $name = $_POST['studentName'];
    $email = $_POST['studentEmail'];
    $dob = $_POST['studentDOB'];
    $address = $_POST['studentAddress'];
    $gender = $_POST['studentGender'];
    $skills = isset($_POST['studentSkills']) ? implode(', ', $_POST['studentSkills']) : '';
    $college = $_POST['college'] === 'Other' ? $_POST['otherCollege'] : $_POST['college'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'student_db');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Check if college already exists
    
        // Check if email already exists
        $checkEmail = "SELECT * FROM student WHERE studentEmail = '$email'";
        $emailResult = $conn->query($checkEmail);

        if ($emailResult->num_rows > 0) {
            echo "Email already registered.";
        } else {
            // Insert data into the database
            $sql = "INSERT INTO student (studentRollNo, studentName, studentEmail, studentDOB, studentAddress, studentGender, studentSkills, college)
                    VALUES ('$rollNo', '$name', '$email', '$dob', '$address', '$gender', '$skills', '$college')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body{
        background-color: yellow;
        border: 3px solid blue;
    }
</style>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Student Registration Form</h2>
        <form action="registers.php" method="POST" id="registrationForm">
            <!-- Student Roll Number -->
            <div class="mb-3">
                <label for="studentRollNo" class="form-label">Student Roll No</label>
                <input type="text" class="form-control" id="studentRollNo" name="studentRollNo" required>
            </div>
            <!-- Student Name -->
            <div class="mb-3">
                <label for="studentName" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentName" name="studentName" required>
            </div>
            <!-- Student Email -->
            <div class="mb-3">
                <label for="studentEmail" class="form-label">Student Email</label>
                <input type="email" class="form-control" id="studentEmail" name="studentEmail" required>
            </div>
            <!-- Student DOB -->
            <div class="mb-3">
                <label for="studentDOB" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="studentDOB" name="studentDOB" required>
            </div>
            <!-- Student Address -->
            <div class="mb-3">
                <label for="studentAddress" class="form-label">Student Address</label>
                <textarea class="form-control" id="studentAddress" name="studentAddress" rows="3" required></textarea>
            </div>
            <!-- Student Gender -->
            <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <input type="radio" id="male" name="studentGender" value="Male" required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="studentGender" value="Female" required>
                <label for="female">Female</label>
            </div>
            <!-- Student Skills -->
            <div class="mb-3">
                <label class="form-label">Skills</label><br>
                <input type="checkbox" id="skill1" name="studentSkills[]" value="HTML">
                <label for="skill1">HTML</label>
                <input type="checkbox" id="skill2" name="studentSkills[]" value="CSS">
                <label for="skill2">CSS</label>
                <input type="checkbox" id="skill3" name="studentSkills[]" value="JavaScript">
                <label for="skill3">JavaScript</label>
            </div>
            <!-- College -->
            <div class="mb-3">
                <label for="college" class="form-label">College</label>
                <select class="form-select" id="college" name="college" required>
                    <option value="" disabled selected>Select your college</option>
                    <option value="College A">VSM Engineering College </option>
                    <option value="College B">VSM Degree College </option>
                    <option value="College C">VSM Inter College </option>
                    <option value="Other">Other</option>
                </select>
                <input type="text" class="form-control mt-2" id="otherCollege" name="otherCollege" placeholder="Enter your college name" style="display: none;">
            </div>
            <!-- Submit Button -->
            <center><button type="submit" class="btn btn-primary">Submit</button></center>
</form>
<hr class="mt-5">
        <h2 class="text-center">Registered Students</h2>
<?php
        // Database connection
$conn = new mysqli('localhost', 'root', '', 'student_db');

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

// SQL query to fetch all students
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    // Display the MySQL error message
    echo "Error in query: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'>";
        echo "<thead><tr><th>ID</th><th>Roll No</th><th>Name</th><th>Email</th><th>DOB</th><th>Address</th><th>Gender</th><th>Skills</th><th>College</th></tr></thead><tbody>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['studentRollNo']}</td>
                <td>{$row['studentName']}</td>
                <td>{$row['studentEmail']}</td>
                <td>{$row['studentDOB']}</td>
                <td>{$row['studentAddress']}</td>
                <td>{$row['studentGender']}</td>
                <td>{$row['studentSkills']}</td>
                <td>{$row['college']}</td>
            </tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-warning'>No students registered yet.</div>";
    }
}

$conn->close();

?>
    </div>
<script>
    $('#college').change(function() {
        if ($(this).val() == 'Other') {
            $('#otherCollege').show();
        } else {
            $('#otherCollege').hide();
        }
    });
</script>
</body>
</html>

