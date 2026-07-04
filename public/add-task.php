<?php


session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<body>

<h1>Add New Task</h1>

<form action="../app/add-task-handler.php" method="POST">

    <label>Title</label><br>
    <input type="text" name="title" required>

    <br><br>

    <label>Description</label><br>

    <textarea
        name="description"
        rows="5"
        cols="50"
    ></textarea>

    <br><br>

    <button type="submit">
        Save Task
    </button>

</form>

<br>

<a href="dashboard.php">
    Back to Dashboard
</a>

</body>
</html>