<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: /public/login.php');
    exit;
}
$email = '';
$password = '';
 if(isset($_POST['email'])){
     $email = trim($_POST['email']);
 }

 if(isset($_POST['password'])){
     $password = trim($_POST['password']);
 }

 if($email === '' || $password === ''){
     $_SESSION['error'] = 'Email and password are riquired!';
     header('Location:/public/login.php');
     exit;
 }
 $sql = "SELECT id ,name,email,password FROM users WHERE email = :email LIMIT 1";
 $stmt = $pdo->prepare($sql);
$stmt->execute([
    ':email' => $email
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    $_SESSION['error'] = 'Invalid email or password!';
    header('Location:/public/login.php');
    exit;
}

if(!password_verify($password, $user['password'])){
    $_SESSION['error'] = 'Invalid email or password!';
    header('Location:/public/login.php');
    exit;
}
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] =  $user['name'];
$_SESSION['user_email'] =  $user['email'];

header('Location: ../public/dashboard.php');
exit;

