<?php
$name = $_GET['name'];
$course = $_GET['course'];
$group = $_GET['group'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome, <?php echo $name; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Welcome, <?php echo $name; ?>!</h1>
        <p>Here is your timetable for <?php echo $course; ?> - <?php echo $group; ?>:</p>
        <a href="timetables/<?php echo strtolower(str_replace(' ', '_', $course)) . '_' . strtolower(str_replace(' ', '_', $group)); ?>.pdf" class="btn-primary" download>
            Download Timetable
        </a>
    </div>
</body>

</html>