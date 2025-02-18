# College Portal

## Overview
This is a web-based College Portal where users can:
- Register and log in.
- Write and view blogs.
- Upload and download exam papers.
- Manage their profile.
- Administer content (if an admin).

## Technologies Used
- **Frontend:** HTML, CSS
- **Backend:** PHP, MySQL
- **Database:** MySQL
- **Authentication:** Session-based login/logout

## Installation
### 1. Clone the Repository
```sh
 git clone https://github.com/Coding-Shanks/College-Website-/CollegeExamPapersWebsite.git
 cd college-portal
```

### 2. Setup Database
- Import the `college_portal.sql` file into your MySQL database.
- Or manually create the database using:
```sql
CREATE DATABASE college_portal;
USE college_portal;

-- Users table  adimin is username and admin123 is password
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blogs table
CREATE TABLE blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Exam Papers table
CREATE TABLE exam_papers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255),
    semester VARCHAR(10),
    file_path VARCHAR(255),
    uploaded_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
);
```

### 3. Configure Database Connection
Edit `config.php` and update the credentials:
```php
$host = "localhost";
$user = "root";
$password = "";
$database = "college_portal";
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
```

### 4. Start the Server
Run the PHP server:
```sh
php -S localhost:8000
```

Now open `http://localhost:8000/index.php` in your browser.

## Features
- **User Registration & Login**: Secure authentication.
- **Blog System**: Users can post and read blogs.
- **Exam Paper Upload**: Upload and download PDF exam papers.
- **Profile Management**: Users can view their details.
- **Admin Dashboard**: Manage uploaded content (for admins).



## Future Enhancements
- User roles & permissions
- Search and filter functionality for blogs & exam papers
- Mobile responsiveness improvements

## Author
Developed by **Coding Shankss** 🚀

## License
This project is licensed under the MIT License.

