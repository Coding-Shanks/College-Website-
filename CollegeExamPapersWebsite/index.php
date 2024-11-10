<?php
session_start();
include('config/db.php');

// Fetch approved blogs
$blogQuery = "SELECT * FROM blogs WHERE status='approved' LIMIT 5";
$blogs = mysqli_query($conn, $blogQuery);

// Fetch latest exam papers
$papersQuery = "SELECT * FROM exam_papers ORDER BY id DESC LIMIT 5";
$papers = mysqli_query($conn, $papersQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTech AI College Portal - Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="blog_post.php">Write Blog</a></li>
                <li><a href="upload_paper.php">Upload Exam Papers</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
        <h1>Welcome to the MTech AI College Portal</h1>
        <p>Share and view exam papers, student blogs, and more.</p>
    </header>

    <section class="content">
        <div class="blogs">
            <h2>Latest Blogs</h2>
            <?php while ($blog = mysqli_fetch_assoc($blogs)): ?>
                <div class="blog-post">
                    <h3><?= $blog['title']; ?></h3>
                    <p><?= substr($blog['content'], 0, 200); ?>...</p>
                    <a href="blog_details.php?id=<?= $blog['id']; ?>">Read more</a>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="papers">
            <h2>Recent Exam Papers</h2>
            <ul>
                <?php while ($paper = mysqli_fetch_assoc($papers)): ?>
                    <li>
                        <a href="<?= $paper['file_path']; ?>"><?= $paper['subject']; ?> (Semester <?= $paper['semester']; ?>)</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 MTech AI College Portal - CDAC Mohali</p>
    </footer>
</body>

</html>