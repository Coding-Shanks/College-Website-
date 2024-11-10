<?php
include('config/db.php');

if (isset($_POST['signup'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = 'student';  // Default role is student

    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($conn, $query);

    echo "<div class='success'>Registration successful! You can now <a href='login.php'>login</a>.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Sign Up</h2>
    <form action="signup.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" required>

        <input type="submit" name="signup" value="Sign Up">
    </form>
</body>

</html>