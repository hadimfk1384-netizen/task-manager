<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name = "viewport" content="width=device-width , initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h1>Register</h1>
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
    <button type="submit">Register</button>


</form>
</body>
</html>
