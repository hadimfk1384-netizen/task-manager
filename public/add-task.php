<?php

require_once "../app/auth-check.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
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