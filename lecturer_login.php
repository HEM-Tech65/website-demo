<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the email exists
    $stmt = $conn->prepare("SELECT name, password, groups FROM lecturers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $hashed_password, $groups);
        $stmt->fetch();

        // Verify the entered password
        if (password_verify($password, $hashed_password)) {
            // Redirect to the welcome page with lecturer details
            header("Location: lecturer_welcome.php?name=" . urlencode($name) . "&groups=" . urlencode($groups));
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
                window.location.href = 'lecturer_register.html';
              </script>";
    }

    $stmt->close();
}
$conn->close();
