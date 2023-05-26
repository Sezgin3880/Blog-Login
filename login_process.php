<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Retrieve the user's login credentials
  $username = $_POST["username"];
  $password = $_POST["password"];

  // Connect to the database
  require_once "config.php";

  // Query the database to check if the user exists
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);

  // Check if the query returned any results
  if (mysqli_num_rows($result) == 1) {

    // Get the stored password hash for the user
    $row = mysqli_fetch_assoc($result);
    $hash = $row["password"];

    // Check if the provided password matches the stored hash
    if (password_verify($password, $hash)) {

      // Store the user's information in the session
      $_SESSION["id"] = $row["id"];
      $_SESSION["username"] = $row["username"];
      $_SESSION["name"] = $row["name"];

      // Redirect the user to the blog page
      header("Location: blog.php");
      exit;
    }
  }

  // Redirect the user back to the login page with an error message
  header("Location: login_failed.php");
  exit;
}
?>