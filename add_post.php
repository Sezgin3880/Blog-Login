<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["id"])) {
  header("Location: index.php");
  exit;
}

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

$title = $_POST['title'];
$description = $_POST['description'];

$sql = "INSERT INTO blogs (title, description) VALUES ('$title', '$description')";