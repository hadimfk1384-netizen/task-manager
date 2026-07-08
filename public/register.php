<?php
require_once "../app/auth-check.php";
$error =" ";
$success =" ";

if(isset($_SESSION['error'])){
    $error =$_SESSION['error'];
}
if(isset($_SESSION['success'])){
    $success = $_SESSION['success'];
}
unset($_SESSION['error']);
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name = "viewport" content="width=device-width , initial-scale=1.0">
    <title>Register</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<body>
<h1>Register</h1>
<?php
 if($error !== ''):
?>
<p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<?php if($success !== ''):?>
    <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>
<form action="../app/register-handler.php" method="post">
<div>
    <label for="name">Name:</label><br>
    <input type="text" name="name"  id="name" required>
</div>
    <br>
    <div>
        <label for="email"" required>Email:</label>
        <input type="email" name="email" id="email" required >

    </div>
    <br>
    <div>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required>
    </div>

    <br>

    <button type="submit">Register</button>


</form>
    <a href="login.php">Already have an account? Login</a>
</body>

</html>
