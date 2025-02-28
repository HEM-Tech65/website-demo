<?php
if (isset($_GET['name']) && isset($_GET['groups'])) {
    $name = urldecode($_GET['name']);
    $groups = urldecode($_GET['groups']);
    $groupList = explode(',', $groups); // Convert groups to an array
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
    <title>Lecturer Welcome</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <img src="Images/logo.png" class="logo">
        <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
        <p>Here are the timetables for the groups you selected:</p>
        <ul>
            <?php foreach ($groupList as $group): ?>
                <?php $filename = "timetables/" . trim($group) . ".pdf"; ?>
                <?php if (file_exists($filename)): ?>
                    <li>
                        <a href="<?php echo $filename; ?>" download>
                            Download timetable for <?php echo htmlspecialchars(trim($group)); ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li style="color: red;">
                        Timetable file not found for <?php echo htmlspecialchars(trim($group)); ?>.
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</body>

</html>