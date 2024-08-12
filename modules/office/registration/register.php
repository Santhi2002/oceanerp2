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
    $checkCollege = "SELECT * FROM student WHERE college = '$college'";
    $collegeResult = $conn->query($checkCollege);

    if ($collegeResult->num_rows > 0) {
        echo "College already registered. Please contact support.";
    } else {
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
    }

    $conn->close();
}
?>
