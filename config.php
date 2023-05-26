<?php
// Database configuration
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "login";

// Create a database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}
?>