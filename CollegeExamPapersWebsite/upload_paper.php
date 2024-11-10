<?php
session_start();
include('config/db.php');

if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
}

if (isset($_POST['upload'])) {
    $subject = $_POST['subject'];
    $semester = $_POST['semester'];
    $file = $_FILES['file']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $query = "INSERT INTO exam_papers (subject, semester, file_path) VALUES ('$subject', '$semester', '$target_file')";
        mysqli_query($conn, $query);
        echo "<div class='success'>Exam paper uploaded successfully.</div>";
    } else {
        echo "<div class='error'>Error uploading file.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Exam Papers</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Upload Exam Papers</h2>
    <form action="upload_paper.php" method="POST" enctype="multipart/form-data">
        <label for="subject">Subject</label>
        <input type="text" name="subject" required>

        <label for="semester">Semester</label>
        <input type="number" name="semester" min="1" max="4" required>

        <label for="file">Upload PDF</label>
        <input type="file" name="file" accept=".pdf" required>

        <input type="submit" name="upload" value="Upload">
    </form>
</body>

</html>