<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/register.php');
    exit;
}
    $name = ''; ;
    $email = '';
    $password = '';
    if(isset($_POST['name'])){
        $name = trim($_POST['name']);
    }
    if(isset($_POST['email'])){
        $email = trim($_POST['email']);
    }
    if(isset($_POST['password'])){
        $password = trim($_POST['password']);
    }

    if($name === '' || $email === '' || $password === '') {
             $_SESSION['error'] ='All fields are riquired';
             header('Location:/register.php');
             exit;
    }
    $checksql= "SELECT id FROM users WHERE email = :email LIMIT 1";
    $checkstmt = $pdo->prepare($checksql);
    $checkstmt->execute([
        ':email' => $email
    ]);
    $user = $checkstmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $_SESSION['error'] = 'This email is already registered';
        header('Location:../public/register.php');
        exit;
    }

try {

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name,email,password) VALUES(:name,:email,:password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $hashedPassword
    ]);
    $_SESSION['success'] = 'Registeration successful now you can log in';
    header('Location:../public/login.php');
    exit;
}catch (PDOException $e) {

   $_SESSION['error'] = 'registeration failed'. $e->getMessage();
   header('Location:../public/register.php');
   exit;
}

?>



