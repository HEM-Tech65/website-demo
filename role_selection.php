<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';
    if ($role === 'student') {
        header('Location: student_login.html');
    } elseif ($role === 'lecturer') {
        header('Location: lecturer_login.html');
    } else {
        echo 'Invalid role selection.';
    }
    exit();
}
?>