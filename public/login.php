<?php
require_once "../app/auth-check.php";
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<h1>Login</h1>

<?php if ($error !== ''): ?>
    <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action="../app/login-handler.php" method="POST">
    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required>
    </div>

    <br>

    <div>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required>
    </div>

    <br>

    <button type="submit">Login</button>
</form>

<br>
<a href="register.php">Don't have an account? Register</a>

</body>
</html>