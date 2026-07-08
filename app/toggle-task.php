<?php
require_once "auth-check.php";
require_once "../config/database.php";

if(!isset($_GET['id'])){
    die("task id not found");
}
$id = (int)$_GET['id'];
$sql = "SELECT status FROM tasks WHERE id = :id AND user_id = :user_id LIMIT 1 ";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $id,
    ':user_id' => $_SESSION['user_id']
]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$task){
    die("task not found");
}
$newstatus = ($task['status'] === 'pending')
    ?'completed'
    : 'pending';
$sql = "UPDATE tasks SET status = :status WHERE id = :id AND user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':status' => $newstatus,
    ':id' => $id,
    ':user_id' => $_SESSION['user_id']
]);
require_once "helpers.php";

setFlashMessage(
    "success",
    "Task updated successfully."
);
header("Location:../public/dashboard.php");
exit;
