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

$sql = "SELECT * FROM blogs";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Blog</title>
  <!-- Tailwind CSS -->
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-200">
  <div class="container mx-auto">
    <div class="flex justify-between p-2">
      <span class="text-xl font-bold">Welcome, <?php echo $_SESSION["username"]; ?></span>
      <a href="logout.php" class="bg-red-500 text-white px-4 py-1.5 rounded-lg">Logout</a>
    </div>
    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <?php 
            $description = substr($row['description'], 0, 32);
            if (strlen($row['description']) > 32) {
                $description .= "...";
            }
        ?>
        <div class="bg-white p-5 rounded-lg shadow mt-10">
          <h3 class="text-xl font-bold"><?php echo $row['title']; ?></h3>
          <p class="text-gray-700"><?php echo $description; ?></p>
          <a href="post.php?id=<?php echo $row['id']; ?>" class="text-blue-500">Read More</a>
          <div class="text-right">
            <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="bg-blue-500 text-white px-3 py-1.5 rounded-lg ml-auto">Edit</a>
            <a href="delete_post.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');" class="bg-red-500 text-white px-3 py-1.5 rounded-lg">Delete Post</a>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center">No blog posts found.</p>
    <?php endif; ?>
  </div>
  <div class="mt-10 text-center">
    <a href="create_post.php" class="bg-blue-500 text-white px-5 py-2 rounded-lg shadow">Create a Post</a>
  </div>
</body>
</html>
