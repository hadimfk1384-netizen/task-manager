<?php
require_once "auth-check.php";
require_once "../config/database.php";
$id = (int)$_POST['id'];
 $title = trim($_POST['title']);
 $description = trim($_POST['description']);

 if($title === ''){
     die("Title is required");
 }
 $sql = "UPDATE tasks
 SET title = :title,
     description = :description
     WHERE id = :id
     AND user_id = :user_id";
 $stmt = $pdo->prepare($sql);
 $stmt->execute([
     ":title" => $title,
     ":description" => $description,
     ":id" => $id,
     ":user_id" => $_SESSION["user_id"]
 ]);
 header("Location:../public/dashboard.php");
 exit();
