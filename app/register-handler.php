<?php
require_once __DIR__ . "../config/Database.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users($name,$email,$password) VALUES(name,email,password)";
    $stmt = mysqli_prepare($conn,$sql)






}
?>