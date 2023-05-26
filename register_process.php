<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Retrieve the user's registration information
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];

  // Connect to the database
  require_once "config.php";

  // Hash the password
  $hash = password_hash($password, PASSWORD_BCRYPT);

  // Insert the user's information into the database
  $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hash', '$email')";
  $result = mysqli_query($conn, $query);

  // Check if the query was successful
  if ($result) {

    // Redirect the user to the login page
    header("Location: index.php");
    exit;
  } else {
    // Redirect the user back to the registration page with an error message
    header("Location: register_failed.php");
    exit;
  }
}
?>