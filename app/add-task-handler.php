<?php
session_start();
require_once "../config/database.php";

if(!isset($_SESSION['user_id'])){
    header("Location: ../public/login.php");
    exit;
}
$title = trim($_POST['title']);
$description = trim($_POST['description']);

if($title === ''){
    die("title is required");

}
$sql = "INSERT INTO tasks
    (user_id,title,description)
    VALUES
    (:user_id ,:title,:description)";


$stmt = $pdo->prepare($sql);
$stmt->execute([
    'user_id' => $_SESSION['user_id'],
    'title' => $title,
    'description' => $description
]);
header("Location: ../public/dashboard.php");
exit;
