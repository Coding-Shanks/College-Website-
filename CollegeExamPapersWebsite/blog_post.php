<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] !== 'student') {
    header('Location: index.php');
}

if (isset($_POST['post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_SESSION['username'];

    $query = "INSERT INTO blogs (title, content, author, status) VALUES ('$title', '$content', '$author', 'pending')";
    mysqli_query($conn, $query);

    echo "<div class='success'>Blog post submitted for approval.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Blog</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Post a Blog</h2>
    <form action="blog_post.php" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" required>

        <label for="content">Content</label>
        <textarea name="content" rows="10" required></textarea>

        <input type="submit" name="post" value="Submit">
    </form>
</body>

</html>