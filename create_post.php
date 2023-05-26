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

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO blogs (title, description) VALUES ('$title', '$description')";
    if (mysqli_query($conn, $sql)) {
        header("Location: blog.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Blog Post</title>
  <!-- Tailwind -->
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-200">
  <div class="container mx-auto">
    <div class="bg-white p-5 rounded-lg shadow mt-10">
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-5">
          <label class="block text-gray-700 font-bold mb-2" for="title">
            Title
          </label>
          <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="title" type="text" name="title" required>
        </div>
        <div class="mb-5">
          <label class="block text-gray-700 font-bold mb-2" for="description">
            Description
          </label>
          <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" id="description" name="description" rows="5" required></textarea>
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</body>