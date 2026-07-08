<?php
require_once "../app/auth-check.php";
require_once "../config/database.php";

if(!isset($_GET['id'])){
    die("Task ID not found");
}
$id = (int)$_GET['id'];
$sql = "SELECT *
        FROM tasks
        WHERE id = :id
        AND user_id = :user_id
        LIMIT 1 ";
 $stmt = $pdo->prepare($sql);
 $stmt->execute([
     ':id' => $id,
     ':user_id' => $_SESSION['user_id']
 ]);
 $task = $stmt->fetch(PDO::FETCH_ASSOC);
 if(!$task){
     die("Task not found");
 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>
<body>

<h1>Edit Task</h1>

<form action="../app/edit-task-handler.php" method="POST">

    <input
        type="hidden"
        name="id"
        value="<?= $task['id'] ?>"
    >

    <label>Title</label>

    <br>

    <input
        type="text"
        name="title"
        value="<?= htmlspecialchars($task['title']) ?>"
        required
    >

    <br><br>

    <label>Description</label>

    <br>

    <textarea
        name="description"
        rows="5"
        cols="50"
    ><?= htmlspecialchars($task['description']) ?></textarea>

    <br><br>

    <button type="submit">
        Update Task
    </button>

</form>

</body>
</html>
