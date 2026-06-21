<?php
require_once __DIR__ . '/../config/database.php';
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('invalid request');
}
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if($name === '' || $email === '' || $password === '') {
        die('all fields are required');
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
    echo "User registered successfully!";
}catch (PDOException $e) {
    echo 'registeration failed' . $e->getMessage();
}

?>