<?php
include('db_config.php');
// check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // get the form data
    $title = $_POST['titleInput'];
    $content = $_POST['contentTextarea'];
    $image = $_FILES['imageInput']['name'];
    $video = $_FILES['videoInput']['name'];

    // move the uploaded files to the uploads folder
    $target_dir = "uploads/";
    $target_image = $target_dir . basename($_FILES["imageInput"]["name"]);
    $target_video = $target_dir . basename($_FILES["videoInput"]["name"]);
    move_uploaded_file($_FILES["imageInput"]["tmp_name"], $target_image);
    move_uploaded_file($_FILES["videoInput"]["tmp_name"], $target_video);

    // insert the post data into the database
    $sql = "INSERT INTO posts (title, content, image, video) VALUES ('$title', '$content', '$image', '$video')";

    if ($conn->query($sql) === TRUE) {
        echo "New post added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
