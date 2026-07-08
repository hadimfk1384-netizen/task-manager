<?php
require_once "auth-check.php";
require_once "../config/database.php";
if(!isset($_GET['id'])){
    die('task id not found');
}
$id = (int)$_GET['id'];
$sql = "DELETE FROM tasks WHERE id = :id AND user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':id' => $id,
    ':user_id' => $_SESSION['user_id']
]);

header("Location:../public/dashboard.php");
exit();

