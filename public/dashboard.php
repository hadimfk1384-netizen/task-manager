<?php

require_once "../app/auth-check.php";
require_once "../app/helpers.php";
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

$flash = getFlashMessage();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Task Manager</h2>

            <p class="text-muted mb-0">
                Welcome
                <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong>
            </p>

        </div>

        <div>

            <a href="add-task.php" class="btn btn-primary">
                ➕ Add Task
            </a>

            <a href="../app/logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>

    <?php if ($flash): ?>

        <div class="alert alert-success">

            <?= htmlspecialchars($flash['message']) ?>

        </div>

    <?php endif; ?>

    <h3 class="mb-4">My Tasks</h3>

    <?php if (empty($tasks)): ?>

        <div class="alert alert-warning">

            No tasks found.

        </div>

    <?php else: ?>

        <?php foreach ($tasks as $task): ?>

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <h4 class="card-title">

                        <?= htmlspecialchars($task['title']) ?>

                    </h4>

                    <p class="card-text">

                        <?= nl2br(htmlspecialchars($task['description'])) ?>

                    </p>

                    <p>

                        <strong>Status :</strong>

                        <?php if ($task['status'] === 'completed'): ?>

                            <span class="badge bg-success">
                                Completed
                            </span>

                        <?php else: ?>

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        <?php endif; ?>

                    </p>

                    <div class="mt-3">

                        <a href="edit-task.php?id=<?= $task['id'] ?>"
                           class="btn btn-warning btn-sm">

                            ✏️ Edit

                        </a>

                        <a href="../app/delete-task.php?id=<?= $task['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this task?')">

                            🗑 Delete

                        </a>

                        <a href="../app/toggle-task.php?id=<?= $task['id'] ?>"
                           class="btn btn-secondary btn-sm">

                            <?= $task['status'] === 'pending'
                                    ? '✅ Mark as Completed'
                                    : '↩️ Mark as Pending' ?>

                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>