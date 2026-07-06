<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}
require_once "../config/database.php";

$sql = "SELECT *
    FROM tasks 
    WHERE user_id = :user_id
    ORDER BY created_at DESC    ";
$stmt = $pdo->prepare($sql);
$stmt->execute([
        'user_id' => $_SESSION['user_id']
]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../app/auth-check.php';

$userName = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<<h1>Dashboard</h1>

<p>Welcome <?= htmlspecialchars($_SESSION['user_name']) ?></p>

<p>
    <a href="add-task.php">➕ Add Task</a>
</p>

<hr>

<h2>My Tasks</h2>

<?php if (empty($tasks)): ?>

    <p>No tasks found.</p>

<?php else: ?>

    <?php foreach ($tasks as $task): ?>

        <div style="border:1px solid #ccc; padding:15px; margin-bottom:15px;">

            <h3><?= htmlspecialchars($task['title']) ?></h3>

            <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>

            <strong>Status:</strong>
            <?= htmlspecialchars($task['status']) ?>

            <br><br>

            <a href="edit-task.php?id=<?= $task['id'] ?>">
                ✏️ Edit
            </a>
        </div>

    <?php endforeach; ?>

<?php endif; ?>
</body>
</html>