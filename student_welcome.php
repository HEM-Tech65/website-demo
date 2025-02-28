<?php
if (isset($_GET['name']) && isset($_GET['course']) && isset($_GET['group'])) {
    $name = urldecode($_GET['name']);
    $course = urldecode($_GET['course']);
    $group = urldecode($_GET['group']);
    $filename = "timetables/" . $course . "_" . $group . ".pdf"; // Dynamic file path
} else {
    echo "Invalid access.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <img src="Images/logo.png" class="logo">
        <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Your timetable for <?php echo htmlspecialchars($course); ?>, <?php echo htmlspecialchars($group); ?> is ready:</p>
        <?php if (file_exists($filename)): ?>
            <a href="<?php echo $filename; ?>" download>
                Download Timetable
            </a>
        <?php else: ?>
            <p style="color: red;">Timetable file not found for your selection.</p>
        <?php endif; ?>
    </div>
</body>

</html>