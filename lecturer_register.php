<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $courses = $_POST['courses'];
    $groups = $_POST['groups'];

    // Prepare SQL statement to insert lecturer's details into the database
    $stmt = $conn->prepare("INSERT INTO lecturers (name, email, password, courses, groups) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $password, $courses, $groups);

    if ($stmt->execute()) {
        // After successful registration, redirect to a welcome page
        header("Location: lecturer_welcome.php?name=" . urlencode($name) . "&groups=" . urlencode($groups));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
