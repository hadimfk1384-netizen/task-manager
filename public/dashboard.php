<?php

require_once "../app/auth-check.php";
require_once "../config/database.php";

$sql = "SELECT *
        FROM tasks
        WHERE user_id = :user_id
        ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);

$stmt->execute([
        ':user_id' => $_SESSION['user_id']
]);

$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h1>Dashboard</h1>

<p>
    Welcome <?= htmlspecialchars($_SESSION['user_name']) ?>
</p>

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

            <p>
                <strong>Status:</strong>

                <?php if ($task['status'] === 'completed'): ?>

                    <span style="color:green;">✅ Completed</span>

                <?php else: ?>

                    <span style="color:red;">⏳ Pending</span>

                <?php endif; ?>

            </p>

            <a href="edit-task.php?id=<?= $task['id'] ?>">
                ✏️ Edit
            </a>

            |

            <a href="../app/delete-task.php?id=<?= $task['id'] ?>"
               onclick="return confirm('Are you sure you want to delete this task?')">
                🗑️ Delete
            </a>

            |

            <a href="../app/toggle-task.php?id=<?= $task['id'] ?>">
                <?= $task['status'] === 'pending'
                        ? '✅ Mark as Completed'
                        : '↩️ Mark as Pending' ?>
            </a>

        </div>

    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>