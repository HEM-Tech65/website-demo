<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists
    $stmt = $conn->prepare("SELECT name, password, course, group_name FROM students WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $hashed_password, $course, $group_name);
        $stmt->fetch();

        // Verify the entered password
        if (password_verify($password, $hashed_password)) {
            // Redirect to the welcome page with student details
            header("Location: student_welcome.php?name=" . urlencode($name) . "&course=" . urlencode($course) . "&group=" . urlencode($group_name));
            exit();
        } else {
            echo "<script>
                    alert('Invalid password.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Account not found. Please register.');
                window.location.href = 'student_register.html';
              </script>";
    }

    $stmt->close();
}
$conn->close();
