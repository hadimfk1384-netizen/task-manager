<?php
require_once __DIR__ . '/../app/auth-check.php';

$userName = $_SESSION['user_name']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<h1>Dashboard</h1>

<p>Welcome, <?php echo htmlspecialchars($userName); ?>!</p>
<p>You are logged in.</p>

<br>
<a href="../app/logout.php">Logout</a>

</body>
</html>