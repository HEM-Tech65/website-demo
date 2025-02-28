<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Passed via hidden input or fetch API for role selection

    if ($role == 'student') {
        $query = $conn->prepare("SELECT * FROM students WHERE email = ?");
    } else {
        $query = $conn->prepare("SELECT * FROM lecturers WHERE email = ?");
    }

    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            if ($role == 'student') {
                header("Location: download.php?name={$user['name']}&course={$user['course']}&group={$user['group_name']}");
            } else {
                header("Location: download_lecturer.php?name={$user['name']}&groups={$user['groups']}");
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Account not registered.']);
    }
}
