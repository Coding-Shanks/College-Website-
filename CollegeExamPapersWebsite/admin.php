<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
}

// Fetch pending blogs
$pendingBlogs = mysqli_query($conn, "SELECT * FROM blogs WHERE status='pending'");

if (isset($_POST['approve'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "UPDATE blogs SET status='approved' WHERE id=$id");
    header('Location: admin.php');
}

if (isset($_POST['reject'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM blogs WHERE id=$id");
    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Admin Dashboard</h2>
    <h3>Pending Blog Posts</h3>
    <?php while ($blog = mysqli_fetch_assoc($pendingBlogs)): ?>
        <div class="blog-post">
            <h3><?= $blog['title']; ?></h3>
            <p><?= $blog['content']; ?></p>
            <form action="admin.php" method="POST">
                <input type="hidden" name="id" value="<?= $blog['id']; ?>">
                <input type="submit" name="approve" value="Approve">
                <input type="submit" name="reject" value="Reject">
            </form>
        </div>
    <?php endwhile; ?>
</body>

</html>