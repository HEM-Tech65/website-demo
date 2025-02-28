<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $school_ID = $_POST['school_ID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password
    $phone_number = $_POST['phone_number'];
    $course = $_POST['course'];
    $group = $_POST['group'];

    // Check if the email already exists
    $checkQuery = $conn->prepare("SELECT * FROM students WHERE email = ?");
    $checkQuery->bind_param("s", $email);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email is already registered!'); window.location.href='student_register.html';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (school_ID, name, email, password, phone_number, course, group_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $school_ID, $name, $email, $password, $phone_number, $course, $group);
        if ($stmt->execute()) {
            // Redirect to download page after successful registration
            header("Location: student_welcome.php?name=$name&course=$course&group=$group");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
