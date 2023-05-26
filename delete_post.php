<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "blog_posts";

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM blogs WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: blog.php");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>