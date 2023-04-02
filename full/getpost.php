<?php
// connect to the database
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// retrieve the posts data from the database
$sql = "SELECT * FROM posts ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<li>';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>' . $row['content'] . '</p>';
        if (!empty($row['image'])) {
            echo '<img src="uploads/' . $row['image'] . '" alt="' . $row['title'] . '">';
        }
        if (!empty($row['video'])) {
            echo '<video src="uploads/' . $row['video'] . '" controls>';
            echo 'Your browser does not support the video tag.';
            echo '</video>';
        }
        echo '</li>';
    }
} else {
    echo 'No posts found';
}

$conn->close();
?>
